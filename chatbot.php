<!-- =============== Chatbot HTML =============== -->
<button id="chatbotToggle" title="Chat with us">
  <i class="bi bi-chat-dots-fill"></i>
</button>

<div id="chatWindow" class="flex-column">
  <div id="chatHeader">Beauty Pharma Chat</div>
  <div id="chatMessages"></div>
  <div id="chatInputArea">
    <input type="text" id="chatInput" class="form-control" placeholder="Type here..." />
    <button id="sendBtn"><i class="bi bi-send-fill"></i></button>
  </div>
</div>

<!-- =============== Chatbot Script =============== -->
<script>
  const toggle = document.getElementById('chatbotToggle');
  const chatWindow = document.getElementById('chatWindow');
  const chatMessages = document.getElementById('chatMessages');
  const chatInput = document.getElementById('chatInput');
  const sendBtn = document.getElementById('sendBtn');

  let step = 0;
  let userResponses = {};

  const botMessages = [
    "Hello! How can I assist you today?",
    "Great, may I have your name?",
    "Thank you, could you provide your email?",
    "And your phone number please?",
    "Thank you, we’ve received your message and will contact you shortly!"
  ];

  function appendMessage(msg, sender = "bot") {
    const div = document.createElement("div");
    div.className = `chat-msg ${sender}`;
    div.innerText = msg;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function showTypingAndRespond(message) {
    const typingDiv = document.createElement("div");
    typingDiv.className = "chat-msg bot typing";
    typingDiv.innerText = "Beauty Pharma is typing";
    chatMessages.appendChild(typingDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    setTimeout(() => {
      typingDiv.remove();
      appendMessage(message, "bot");
    }, 2500);
  }

  function handleUserInput() {
    const input = chatInput.value.trim();
    if (!input) return;

    appendMessage(input, "user");
    chatInput.value = "";

    setTimeout(() => {
      switch (step) {
        case 0:
          userResponses.issue = input;
          showTypingAndRespond(botMessages[1]);
          step++;
          break;
        case 1:
          userResponses.name = input;
          showTypingAndRespond(botMessages[2]);
          step++;
          break;
        case 2:
          userResponses.email = input;
          showTypingAndRespond(botMessages[3]);
          step++;
          break;
        case 3:
          userResponses.phone = input;
          showTypingAndRespond(botMessages[4]);
          step++;
          break;
        default:
          showTypingAndRespond("Thanks again! Have a great day.");
      }
    }, 500);
  }

  toggle.onclick = () => {
  if (chatWindow.style.display === "none" || !chatWindow.style.display) {
    chatWindow.style.display = "flex";
    if (step === 0 && chatMessages.children.length === 0) {
      appendMessage(botMessages[0], "bot");
    }
  } else {
    chatWindow.style.display = "none";
  }
};


  sendBtn.onclick = handleUserInput;
  chatInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") handleUserInput();
  });
</script>