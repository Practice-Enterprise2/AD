{{-- -*-html-*- --}}

@php
  use App\Models\User;
@endphp
<x-app-layout>

  <div
    class="mx-auto my-10 flex h-full w-10/12 flex-row justify-center rounded-lg bg-slate-400 p-6">
    <div
      class="flex h-96 w-2/6 flex-col items-center justify-start overflow-y-auto border-r-2 border-r-black">
      @foreach ($chatboxs as $chatbox)
        @if (Auth::user()->can('view_all_complaints'))
          <a href="#"
            class="chatbox my-1 w-8/12 rounded-xl bg-slate-700 p-3 text-center text-white"
            data-chat="{{ $chatbox->id }}">{{ User::where('id', $chatbox->customer_id)->get()->first()->name }}</a>
        @else
          <a href="#"
            class="chatbox my-1 w-8/12 rounded-xl bg-slate-700 p-3 text-center text-white"
            data-chat="{{ $chatbox->id }}">{{ User::where('id', $chatbox->employee_user_id)->get()->first()->name }}</a>
        @endif
      @endforeach

    </div>
    <div class="flex h-96 w-4/6 flex-col gap-5 p-5">
      <div class="flex h-96 w-full flex-col gap-5 overflow-y-auto p-5"
        id="chat-message">

      </div>
      <div class="w-full" id="send-form">

      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let viewChatID = document.querySelectorAll('.chatbox');
      let messageContainer = document.getElementById('chat-message');
      let formContainer = document.getElementById('send-form');
      viewChatID.forEach((chatID) => {
        const chat = chatID.getAttribute('data-chat');
        chatID.addEventListener('click', (event) => {
          console.log('clicked');
          event.preventDefault();
          loadMessage(chat);
        });
      });

      function loadMessage(chatID) {
        console.log(Object.keys(Echo.connector.channels));
        let channelNames = Object.keys(Echo.connector.channels);
        channelNames.forEach((channelName) => {
          Echo.leave(channelName);
        });
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              console.log(xhr.responseText);
              var messages = JSON.parse(xhr.responseText);
              var messageHtml = '';
              for (let i = 0; i < messages.length; i++) {
                let createdDate = new Date(messages[i].created_at);
                let formattedDate =
                  `${createdDate.getDate()}/${createdDate.getMonth()+1}/${createdDate.getFullYear()}-${createdDate.getHours()}:${createdDate.getMinutes()}`;
                if ("{{ Auth::user()->id }}" === `${messages[i].from_id}`) {
                  messageHtml += `
                        <div class="self-end">
                        <div class="p-3 bg-slate-700 inline-block rounded-xl text-white">
                            <p class="">` + messages[i].content + `</p>
                            <p class="text-xs text-gray-300">` +
                    formattedDate + `</p>
                        </div>
                        </div>
                    `;
                } else {
                  messageHtml += `
                        <div class="self-start">
                        <div class="p-3 bg-slate-700 inline-block rounded-xl text-white">
                            <p class="">` + messages[i].content + `</p>
                            <p class="text-xs text-gray-300">` +
                    formattedDate + `</p>
                        </div>
                        </div>
                    `;
                }
              }
              messageContainer.innerHTML = messageHtml;
              const element = document.querySelectorAll('.overflow-y-auto');
              element.forEach((element, index) => {
                if (index === 1) {
                  element.scrollTop = element.scrollHeight - element
                    .clientHeight;
                }
              });
              formContainer.innerHTML = ` 
                        <form class="w-full" id="form">
                            <input type="hidden" name="id" id="input-chatID" value="${chatID}"/>
                            <input type="text" id="input-message" name="content" placeholder="send message" class="w-full p-2 rounded-md text-black"/>
                        </form>`;
              const form = document.getElementById('form');
              const inputMessage = document.getElementById('input-message');
              const inputChatId = document.getElementById('input-chatID');
              form.addEventListener('submit', function(event) {
                event.preventDefault();
                const userInput = inputMessage.value;
                const chatIDInput = inputChatId.value;
                axios.post('/chat-message', {
                  content: userInput,
                  id: chatIDInput
                }, {
                  headers: {
                    'X-CSRF-TOKEN': document.querySelector(
                      'meta[name="csrf-token"]').getAttribute(
                      'content')
                  }
                })
                inputMessage.value = '';
              });
              const channel = Echo.private('private.chat.' + chatID);
              channel.subscribed(() => {
                console.log('subscribed');
              }).listen('.chat-message', (event) => {
                console.log(event);
                let messageEvent = '';
                let currentDate = new Date();
                // Format date
                let formattedDate = ("0" + currentDate.getDate()).slice(
                    -2) + "/" +
                  ("0" + (currentDate.getMonth() + 1)).slice(-2) + "/" +
                  currentDate.getFullYear();
                // Format time
                let formattedTime = ("0" + currentDate.getHours())
                  .slice(-2) + ":" +
                  ("0" + currentDate.getMinutes()).slice(-2);
                // Combine date and time
                let dateTime = formattedDate + "-" + formattedTime;
                if ("{{ Auth::user()->id }}" === `${event.userId}`) {
                  messageEvent += `
                                <div class="self-end">
                                <div class="p-3 bg-slate-700 inline-block rounded-xl text-white">
                                    <p class="">` + event.message + `</p>
                                    <p class="text-xs text-gray-300">` +
                    dateTime + `</p>
                                </div>
                                </div>
                            `;
                } else {
                  messageEvent += `
                                <div class="">
                                <div class="p-3 bg-slate-700 inline-block rounded-xl text-white">
                                    <p class="">` + event.message + `</p>
                                    <p class="text-xs text-gray-300">` +
                    dateTime + `</p>
                                </div>
                                </div>
                            `;
                }
                messageContainer.insertAdjacentHTML('beforeend',
                  messageEvent);

                element.forEach((element, index) => {
                  if (index === 1) {
                    element.scrollTop = element.scrollHeight -
                      element.clientHeight;
                  }
                });
              })
            } else {
              console.log('error: ' + xhr.status);
            }
          }
        }
        xhr.open('GET', '/messages/content/' + chatID, true);
        xhr.send();
      }
    });
  </script>
</x-app-layout>
