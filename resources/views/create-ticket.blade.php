{{-- -*-html-*- --}}

<x-app-layout>
  <div>

    <form method="POST" action="{{ route('submitted-ticket') }}">
      @csrf
      <label for="cstID">Cst ID</label>
      <input type="text" name="cstID" id="cstID"
        value="{{ old('CstID') }}" required>

      <label for="issue">Issue</label>
      <input type="text" name="issue" id="issue"
        value="{{ old('Issue') }}" required>

      <label for="description">Description</label>
      <textarea name="description" id="description" required>{{ old('description') }}</textarea>

      <button type="submit">Submit</button>
    </form>

  </div>
</x-app-layout>
