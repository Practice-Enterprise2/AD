{{-- -*-html-*- --}}

<x-app-layout>
  <h1>Complaint Response</h1>

  <p><strong>Customer Name:</strong> {{ $complaint->customer_name }}</p>
  <p><strong>Customer Email:</strong> {{ $complaint->customer_email }}</p>
  <p><strong>Complaint Message:</strong> {{ $complaint->complaint_message }}</p>

  <form method="POST" action="{{ route('complaints.store', $complaint->id) }}">
    @csrf

    <div class="form-group">
      <label for="response_message">Response Message</label>
      <textarea name="response_message" id="response_message" class="form-control"
        rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Response</button>
  </form>
</x-app-layout>
