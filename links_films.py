import telebot
import json
import time

TOKEN = 'YOUR_BOT_TOKEN_HERE'
bot = telebot.TeleBot(TOKEN)

# Загружаем фильмы из JSON-файла
def load_movies():
    with open("movies.json", "r", encoding="utf-8") as file:
        return json.load(file)

@bot.message_handler(commands=['films'])
def send_welcome(message):
    text = (
        "👋 Hello!\n\n"
        "This bot will help you find a movie title by its number 🎬\n\n"
        "📌 Just send a number (for example: 3), and I'll send you the title of a movie from the list.\n\n"
        "If there's no movie with that number, I'll let you know.\n\n"
        "💡 Make sure you only enter a number, no extra characters."
    )
    bot.send_message(message.chat.id, text)

# Обрабатываем любое текстовое сообщение
@bot.message_handler(func=lambda message: True) #Этот код говорит боту: "Обрабатывай все сообщения". Функция lambda message: True всегда возвращает True, поэтому бот будет реагировать на любое сообщение. Это полезно, если ты хочешь, чтобы бот отвечал на все сообщения, а не только на команды или специальные запросы. (@bot.message_handler(func=lambda message: True)
def handle_message(message):
    movies = load_movies()
    text = message.text.strip()

    if text.isdigit():
        movie = movies.get(text)
        if movie:
            bot.send_message(message.chat.id, f"Film number {text}: 🎬 {movie}")
        else:
            bot.send_message(message.chat.id, "❌ Movie with this number not found.")
    else:
        bot.send_message(message.chat.id, "⚠️ Enter the movie number (digit).")

print("Запуск бота", end="")
for i in range(3):
    print(".", end="", flush=True)
    time.sleep(0.5)
print("\n" + "=" * 30)
print("✅ The bot has been launched successfully!")
print("=" * 30)
bot.polling()

