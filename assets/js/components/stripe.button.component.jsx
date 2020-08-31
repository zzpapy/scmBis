import React from 'react';
import StripeCheckout from 'react-stripe-checkout';

const StripeCheckoutButton = ({ price }) => {
    const priceForStripe = price * 100;
    const publishableKey = 'pk_test_51HL4HeDz4TKnqe2ZOCU3IUhRRfbZt8WFqE5pWvGc8VuaaUQ3n2PxquMrfgNawh8QlAV1FbO5pKQKUFeeOeo27pDI00pNG9VcQW';

    const onToken = (token,response) => {
        console.log(token,response);
        alert('Payment Succesful!');
    };

    return (
        <StripeCheckout
            label='Payer'
            name='Freaky Jolly Co.'
            // billingAddress
            // shippingAddress
            image='https://www.freakyjolly.com/wp-content/uploads/2020/04/fj-logo.png'
            description={`total € ${price} `}
            amount={priceForStripe}
            panelLabel='Payer'
            country='fr'
            currency= 'EUR'
            token={onToken}
            stripeKey={publishableKey}
        />
    )
}

// carte fantome: 4242 4242 4242 4242 01/28  123

export default StripeCheckoutButton;