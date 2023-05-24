{{-- -*-html-*- --}}

<x-public-layout>
  <style>
    h1 {
      font: bold;
      font-size: xx-large;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    select#rating {
      padding: 5px 10px;
      font-size: 16px;
      border: 2px solid #ccc;
      border-radius: 4px;
      margin-right: 10px;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 18px;
      margin-bottom: 10px;
    }

    button[type="submit"]:hover {
      background-color: #3e8e41;
    }
  </style>
  <h1>Customer Reviews</h1>

  <form method="GET" action="{{ route('reviews.index') }}">
    <label for="rating">Filter by Rating:</label>
    <select id="rating" name="rating">
      <option value>All Ratings</option>
      @for ($i = 1; $i <= 5; $i++)
        <option value="{{ $i }}"
          {{ $rating == $i ? ' selected' : '' }}>
          {{ $i }} Star{{ $i > 1 ? 's' : '' }}
        </option>
      @endfor
    </select>
    <button type="submit">Filter</button>
  </form>

  <div class="reviews">
    <table>
      <tr>
        <th>Rating</th>
        <th>Comment</th>
      </tr>
      @foreach ($review as $reviews)
        @if (!$rating || $reviews->rating == $rating)
          <div class="review">
            <div class="review__body">
              <tr>
                <td>{{ $reviews->rating }}</td>
                <td>{{ $reviews->comment }}</td>
              </tr>
            </div>
          </div>
        @endif
      @endforeach
    </table>
  </div>
</x-public-layout>
{{-- vim: ft=html
--}}
