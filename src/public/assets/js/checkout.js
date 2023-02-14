let ss_p = document.getElementById("ss_val").value;
const stripe = Stripe(ss_p);

window.items = [{ price: $(".net_amount").attr("val")  }];

let elements;

const appearance = {
  theme: 'stripe',

  variables: {
    colorPrimary: '#0570de',
    colorBackground: '#ffffff',
    colorText: '#7f7f7f',
    colorDanger: '#df1b41',
    fontFamily: 'Ideal Sans, system-ui, sans-serif',
    // spacingUnit: '2px',
    // borderRadius: '4px',
    // See all possible variables below
  }
};

initialize();
checkStatus();

document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

// Fetches a payment intent and captures the client secret
async function initialize() {

    $.ajax({
        type: "POST",
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            body: JSON.stringify({ items }),
        },
        url: "checkout_create_php",
        async: false,
        dataType: 'json',
        success: function(data) {
            const { clientSecret } = data;
            elements = stripe.elements({ clientSecret, appearance});
            
            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");

        },
        error: function(Data) {
            alertify.error("Error to init")
            console.log(Data)
        }
    });
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      return_url: "https://dashboard.blinkswag.com/cart",
    },
  }).then(function(result) {
    if (result.error) {
    }
  });

  if (error.type === "card_error" || error.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occurred.");
  }

  setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
  const clientSecret = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
  );

  if (!clientSecret) {
    return;
  }

  const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

  switch (paymentIntent.status) {
    case "succeeded":
      showMessage("Payment succeeded!");
      break;
    case "processing":
      showMessage("Your payment is processing.");
      break;
    case "requires_payment_method":
      showMessage("Your payment was not successful, please try again.");
      break;
    default:
      showMessage("Something went wrong.");
      break;
  }
}

// ------- UI helpers -------

function showMessage(messageText) {
  const messageContainer = document.querySelector("#payment-message");

  messageContainer.classList.remove("hidden");
  messageContainer.textContent = messageText;

  setTimeout(function () {
    messageContainer.classList.add("hidden");
    messageText.textContent = "";
  }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector("#submit").disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    document.querySelector("#submit").disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
}