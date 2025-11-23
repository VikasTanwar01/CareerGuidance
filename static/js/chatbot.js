document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("chatbot-toggle");
  const box = document.getElementById("chatbot-container");
  const messages = document.getElementById("chatbot-messages");
  const input = document.getElementById("chatbot-text");
  const sendBtn = document.getElementById("chatbot-send");

  // Show/Hide Chatbox
  toggle.addEventListener("click", () => {
    box.style.display = box.style.display === "flex" ? "none" : "flex";
  });

  function addMessage(text, who) {
    const div = document.createElement("div");
    div.classList.add("chat", who);
    div.textContent = text;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
  }

  async function sendMessage() {
    const text = input.value.trim();
    if (!text) return;

    addMessage(text, "user");
    input.value = "";

    const response = await fetch("/career/chatbot.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message: text })
    });

    const data = await response.json();
    addMessage(data.reply, "bot");
  }

  sendBtn.addEventListener("click", sendMessage);

  input.addEventListener("keydown", (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });
});
