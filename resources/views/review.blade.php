{{-- -*-html-*- --}}

<x-app-layout>
  <style>
    h1 {
      font-size: 28px;
      margin-bottom: 20px;
    }

    strong {
      font-weight: bold;
    }

    p {
      margin-bottom: 10px;
    }

    #rating {
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
      margin: 0 auto;
      text-align: center;
      width: 30%;
    }

    #rating h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    #rating p {
      margin-bottom: 20px;
    }

    #rating label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    #rating input[type="number"],
    #rating textarea {
      display: block;
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      line-height: 1.4;
      margin-bottom: 20px;
    }

    #rating button[type="submit"] {
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    #rating button[type="submit"]:hover {
      background-color: #0062cc;
    }
  </style>
  <div id="rating">
    <p>
      Thank you for choosing our shipping service!<br> We hope you had a great
      experience requesting a shipment with us. We would love to hear your
      feedback on how easy or difficult the process was for you.<br> Would you
      like to take a few minutes to leave a review and let us know your
      thoughts? Your feedback will help us improve our service and provide a
      better experience for our customers in the future.<br> Thank you!
    <p>
    <form method="POST" action="{{ route('reviews.store') }}">
      @csrf

      <div>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1"
          max="5" required>
      </div>

      <div>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
      </div>

      <button type="submit">Submit Review</button>
    </form>
  </div>
</x-app-layout>
