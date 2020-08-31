import {Elements} from '@stripe/react-stripe-js';
import {loadStripe} from '@stripe/stripe-js';

// Make sure to call `loadStripe` outside of a component’s render to avoid
// recreating the `Stripe` object on every render.
import {CardElement} from '@stripe/react-stripe-js';

const stripePromise = loadStripe('pk_test_51HL4HeDz4TKnqe2ZOCU3IUhRRfbZt8WFqE5pWvGc8VuaaUQ3n2PxquMrfgNawh8QlAV1FbO5pKQKUFeeOeo27pDI00pNG9VcQW');


function Elems () {
  return (
    <Elements stripe={stripePromise}>
      <CardElement
        options={{
            style: {
            base: {
                fontSize: '16px',
                color: '#424770',
                '::placeholder': {
                color: '#aab7c4',
                },
            },
            invalid: {
                color: '#9e2146',
            },
            },
        }}
        />
    </Elements>
  );
};

class TestElement extends HTMLElement{
    
    connectedCallback(){
       render( <Elems />, this)
    }

    // disconnectedCallBack (){
    //     unmountComponentAtNode(this)
    // }
}


customElements.define('card-card',TestElement)