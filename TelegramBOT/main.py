import telebot

from telebot import types #очень важна для кнопок!!!!

import random

TOKEN = ('7557110475:AAEey7LMDGI4ibCg2v44YkwxidbBcuwqxFA')
bot = telebot.TeleBot(TOKEN)


@bot.message_handler(commands=['help'])
def help(call):
    bot.send_message(call.chat.id, text_helps)

text_helps = (""" Этот бот владеет таки командами как 
/start
/help 
/info
/check
""")

@bot.message_handler(commands=['roll'])
def roll(call):
    bot.send_message(call.chat.id, "Нажмите на кнопку для рандомного числа: 🎲")
    keyboard = types.InlineKeyboardMarkup()  # Обязательно нужно создавать кнопку
    button1 = types.InlineKeyboardButton("Рандомное число", callback_data="roll_number")


    keyboard.add(button1) # Добавить кнопку


    bot.send_message(call.chat.id, "Нажмите на кнопку, чтобы получить случайное число.", reply_markup=keyboard)


@bot.callback_query_handler(func=lambda call: call.data == "roll_number")
def handle_random_number(call):
    # Генерация случайного числа
    random_number = random.randint(1, 100)

    # Отправляем пользователю случайное число
    bot.answer_callback_query(call.id)  # Убираем индикатор загрузки
    bot.send_message(call.message.chat.id, f"Ваше случайное число: {random_number}")








######СДЕЛАТЬ КОМАНДУ ДЛЯ ЗАГРУЗОК ФОТО#######










@bot.message_handler(commands=['info'])
def info(call):
    bot.send_message(call.chat.id, text_info)

text_info = ("""Этот бот создан исключительно в развлекательных целях!!!⚠️

Он предназначен для того, чтобы приносить радость и веселье пользователям, предлагая различные функции и команды для взаимодействия.

Пожалуйста, не используйте бота для целей, нарушающих правила и законы. Мы надеемся, что вы получите удовольствие от общения с ним!📍""")




@bot.message_handler(commands=['links'])
def checker(call):  
    keyboard = types.InlineKeyboardMarkup()  # Обязательно нужно создавать кнопку
    button1 = types.InlineKeyboardButton("Открыть Discord", url="https://discord.gg/6nZNqJ3uKM")
    button2 = types.InlineKeyboardButton("Открыть сайт", url="https://www.youtube.com/watch?v=HeKXdqmRhc0")

    keyboard.add(button1, button2)  

    bot.send_message(call.chat.id, "Выберите действие:", reply_markup=keyboard)  # Теперь сообщение отправляется| Также важно писать reply_markup для вывода сообщений







# bot.send_message(message.chat.id, "Выберите действие:", reply_markup=keyboard)
# Бот отправляет сообщение "Выберите действие:", а вместе с ним появляется кнопка(и) из keyboard.

# Как убрать клавиатуру?
# Чтобы скрыть кнопки после нажатия, можно использовать:
# bot.send_message(message.chat.id, "Клавиатура скрыта", reply_markup=types.ReplyKeyboardRemove())
# Это удалит клавиатуру после нажатия.

# @bot.message_handler(func=lambda message: message.text == "Меню")
# def show_menu(message):
#     bot.send_message(message.chat.id, "Вы открыли меню!", reply_markup=types.ReplyKeyboardRemove())













# Флаг для остановки бота
bot_running = True

# Команда для начала работы бота
@bot.message_handler(commands=['start'])
def start(message):
    global bot_running
    if bot_running:
        bot.send_message(message.chat.id, "Бот работает. ")
    else:
        bot.send_message(message.chat.id, "Бот остановлен.")

# Команда для остановки бота
@bot.message_handler(commands=['stop'])
def stop(message):
    global bot_running
    bot.send_message(message.chat.id, "Бот остановлен. Для перезапуска используйте /start.")
    bot.stop_polling()  






bot.polling() #bot.infinity_polling() работает также как и non_stop не даёт завершиться прогремме

















# def help(helps):
#     bot.send_message(helps.chat.id, text_helps)


#  Здесь helps — это объект сообщения (message), который передаётся в функцию help.
# 🔹 helps.chat.id означает, что мы берём ID чата, откуда пришло сообщение.

# 💡 Пример, чтобы запомнить:
# Представь, что helps — это коробка с письмом от пользователя. Внутри коробки (helps) лежит конверт (helps.chat), а в конверте написан адрес (helps.chat.id).







#class Dog:
#    def __init__(self, name):
#        self.name = name  # self указывает на сам объект
#
#    def bark(self):
#        print(f"{self.name} говорит: Гав!")

#dog1 = Dog("Бобик")  # создаём объект
#dog1.bark()  # Выведет: "Бобик говорит: Гав!"

