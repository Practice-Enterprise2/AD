<x-app-layout>
    <style>
h1 {
    font: bold;
    font-size: xx-large;
}
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {
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

    <form method="GET" action="/filterreview">
        <label for="rating">Filter by Rating:</label>
        <select id="rating" name="rating">
            <option value="">All Ratings</option>
            <option value="1"{{ $rating == '1' ? ' selected' : '' }}>1 Star</option>
            <option value="2"{{ $rating == '2' ? ' selected' : '' }}>2 Stars</option>
            <option value="3"{{ $rating == '3' ? ' selected' : '' }}>3 Stars</option>
            <option value="4"{{ $rating == '4' ? ' selected' : '' }}>4 Stars</option>
            <option value="5"{{ $rating == '5' ? ' selected' : '' }}>5 Stars</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <div class="reviews">
        <table>
        <tr>
            <th>ID</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>
        @foreach ($review as $reviews)
        @if (!$rating || $reviews->rating == $rating)
            <div class="review">
                <div class="review__body">
                    <tr>
                    <td>{{$reviews->id}}</td>
                    <td>{{ $reviews->rating}}</td>
                    <td>{{ $reviews->comment }}</td>
                    </tr>
                </div>
            </div>
            @endif
        @endforeach
        </table>
    </div>
</x-app-layout>
