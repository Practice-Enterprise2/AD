<x-app-layout>
  <style>
    h1 {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }

    h3 {
      font-size: 20px;
      font-weight: bold;
      margin-top: 30px;
    }

    p {
      margin-bottom: 20px;
    }

    ol {
      list-style: decimal;
      margin-left: 0;
      padding-left: 30px;
    }

    .link#contactus {
      color: #007bff;
      text-decoration: none;
      text-align: center;
    }

    .link:hover#contactus {
      color: #0056b3;
      text-align: center;
    }
  </style>
  <h1>Frequently asked questions</h1>
  <br>
  <x-nav-link id="contactus" :href="route('contact.create')" class="link"> contact us</x-nav-link>
  <ol>
    <li>
      <h3>What is the delivery time for my shipment?</h3>
      <p>The delivery time depends on the distance of the shipment. Shipments
        are usually comfirmed within 1-2 business days, then we will try to
        provide the fastest shipment time as posible</p>
    </li>
    <li>
      <h3>Can I track my shipment?</h3>
      <p>Yes, you can track your shipments using the show shipment submenu under
        the item shipments.</p>
    </li>
    <li>
      <h3>What happens if my shipment is damaged or lost?</h3>
      <p>In the rare case that your shipment is damaged or lost, please contact
        our customer service immediately. We will do our best to resolve the
        issue and compensate for any damages or loss.</p>
    </li>
    <li>
      <h3>Can I modify/cancel my shipment details after I have submitted them?
      </h3>
      <p>Yes, you can modify your shipment details as long as your shipment has
        not been confirmed yet. Please contact our customer service if you need
        to make any changes or cancel it in your shipment requests.</p>
    </li>
    <li>
      <h3>What happens if no one is present at the delivery address?</h3>
      <p>If no one is present at the delivery address when the shipment is
        delivered, the courier will leave a note with instructions on how to
        pick up the shipment or schedule a new delivery.</p>
    </li>
    <li>
      <h3>How do you calculate shipping costs?</h3>
      <p>Shipping costs are calculated based on the pickup location, destination
        location, size and weight of the shipment. Enter your shipment details
        on our website to get an estimate of shipping costs.</p>
    </li>
    <li>
      <h3>What payment methods do you accept?</h3>
      <p>We accept payments with credit card, PayPal, and bank transfer. You can
        choose the payment method that suits you best during the checkout
        process.</p>
    </li>
    <li>
      <h3>Can I receive an invoice for my shipment?</h3>
      <p>Yes, you can receive an invoice for your shipment. This will be done
        automatically if you haven't received any please contact us.</p>
    </li>
    <li>
      <h3>Do you offer international shipments?</h3>
      <p>Yes, we offer international shipments. Enter your shipment details on
        our website to see if we offer shipments to your destination. Please
        note that international shipments may take longer than domestic
        shipments.</p>
    </li>
    <li>
      <h3>What are your customer service hours?</h3>
      <p>Our customer service is open Monday through Friday, from 9:00am to
        5:00pm. You can reach us by phone, email, or live chat.</p>
    </li>
  </ol>
</x-app-layout>
