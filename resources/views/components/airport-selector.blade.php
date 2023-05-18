{{-- -*-html-*- --}}

<div
  class="airport-selector relative relative inline-flex flex-col justify-center text-gray-500">
  <div class="relative">
    <input type="text" class="search p-2 pl-8" placeholder="search..." />
    <input type="text" disabled
      class="iata-code disabled w-16 bg-slate-600 text-center text-slate-400"
      name="{{ $inputName }}">
    <svg class="absolute left-2.5 top-3.5 h-4 w-4"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  </div>
  <div class="relative">
    <ul class="list absolute top-0 w-full border border-gray-100 bg-white"></ul>
  </div>
</div>

@once
  <template id="airportSelectorTemplate">
    <li class="border-gray-100 bg-slate-500 p-2 hover:bg-slate-700">
      <button class="w-full text-left">
      </button>
    </li>
  </template>

  <script>
    function removeAllChildNodes(parent) {
      while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
      }
    }
    //bron https://www.freecodecamp.org/news/javascript-debounce-example/
    function debounce(func, timeout = 300) {
      let timer;
      return (...args) => {
        if (!timer) {
          func.apply(this, args);
        }
        clearTimeout(timer);
        timer = setTimeout(() => {
          timer = undefined;
        }, timeout);
      };
    }
    const airportTemplate = document.querySelector("#airportSelectorTemplate");

    window.addEventListener("load", () => {
      document.querySelectorAll('.airport-selector').forEach(component => {
        const ul = component.querySelector('.list');
        const hiddenfield = component.querySelector(".iata-code");
        const searchfield = component.querySelector('.search');

        component.addEventListener("focusout", event => {
          if (!component.contains(event.relatedTarget)) {
            removeAllChildNodes(ul);
          }
        });

        const search = async event => {
          if (event.target.value.length < 3) {
            removeAllChildNodes(ul);
            return;
          }
          console.log('searching', event.target.value);
          const response = await fetch('/airlines?' +
            new URLSearchParams({
              query: event.target.value
            }));
          const data = await response.json();
          if (data.error) {
            return;
          }
          removeAllChildNodes(ul);
          for (const airport of data) {
            const li = airportTemplate.content.cloneNode(true);
            const button = li.querySelector('button');
            button.textContent = airport.name;
            button.addEventListener('click', function() {
              hiddenfield.value = airport.iata_code;
            });
            ul.appendChild(li);
          }
        };

        searchfield.addEventListener("input", debounce(search));
        searchfield.addEventListener("focusin", search);
      });
    });
  </script>
@endonce
