@php
    use App\Models\User;
@endphp
<x-app-layout>
@vite('resources/js/test.js')

<div class=" w-10/12 h-full flex flex-row justify-center bg-slate-400 mx-auto my-10 rounded-lg p-6">
    <div  class="w-2/6 h-96 flex flex-col border-r-black border-r-2  items-center justify-start overflow-y-auto">
    @foreach($chatboxs as $chatbox)
    @if(Auth::user()->role == 0)
    <a href="#" class="chatbox w-8/12 p-3 my-1 text-center bg-slate-700 rounded-xl text-white" data-chat="{{ $chatbox->id }}">{{ User::where('id', $chatbox->employee_id)->get()->first()->name }}</a>
    @elseif(Auth::user()->role == 1)
    <a href="#" class="chatbox w-8/12 p-3 my-1 text-center bg-slate-700 rounded-xl text-white" data-chat="{{ $chatbox->id }}">{{ User::where('id', $chatbox->customer_id)->get()->first()->name }}</a>
    @endif
@endforeach
    <a href="#" class="chatbox w-8/12 p-3 my-1 text-center bg-slate-700 rounded-xl text-white" data-chat="1">test</a>

    </div>
    <div class=" w-4/6 h-96 p-5 flex flex-col gap-5">
        <div class=" w-full h-96 p-5 flex flex-col gap-5 overflow-y-auto" id="chat-message">
        
        </div>
        <form class="w-full">
            <input type="text" placeholder="send message" class="w-full p-2 rounded-md"/>
        </form>
    </div>
</div>
<script>
  const element = document.querySelectorAll('.overflow-y-auto');
  element.forEach((element, index) => {
    if(index === 1)
    {
    element.scrollTop = element.scrollHeight - element.clientHeight;
    }
  });
  document.addEventListener('DOMContentLoaded', function(){
    let viewChatID = document.querySelectorAll('.chatbox');
    let messageContainer = document.getElementById('chat-message');

    viewChatID.forEach((chatID) => {
        const chat = chatID.getAttribute('data-chat');
        chatID.addEventListener('click', (event) => {
            console.log('clicked');
            event.preventDefault();
            loadMessage(chat);
        });
    });

    function loadMessage(chatID)
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status === 200)
                {
                    console.log(xhr.responseText);
                    var messages = JSON.parse(xhr.responseText);
                    var messageHtml = '';
                    for(let i = 0; i < messages.length; i++)
                    {
                        let createdDate = new Date(messages[i].created_at);
                        let formattedDate = `${createdDate.getDate()}/${createdDate.getMonth()+1}/${createdDate.getFullYear()}-${createdDate.getHours()}:${createdDate.getMinutes()}`;
                        if("{{Auth::user()->id}}" === `${messages[i].from_id}`)
                        {
                        messageHtml += `
                        <div class="self-end">
                        <div class="p-3 bg-slate-700 inline-block rounded-xl text-white">
                            <p class="">`+messages[i].content+`</p>
                            <p class="text-xs text-gray-300">`+formattedDate+`</p>
                        </div>
                        </div>
                    `;
                        }
                        else
                        {
                            messageHtml += `
                        <div class="self-start">
                        <div class="p-3 bg-slate-700 inline-block rounded-xl text-white">
                            <p class="">`+messages[i].content+`</p>
                            <p class="text-xs text-gray-300">`+formattedDate+`</p>
                        </div>
                        </div>
                    `;
                        }
                    }
                    messageContainer.innerHTML = messageHtml;
                }
                else
                {
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
