
import logging
import os
from telegram import Update, InlineKeyboardButton, InlineKeyboardMarkup, InputFile
from telegram.ext import Updater, CommandHandler, CallbackQueryHandler, CallbackContext
from datetime import datetime, timedelta

# Bot tokeninizi buraya ekleyin
TOKEN = '7112791233:AAEDf828SUc-Pbd4m5mLsZtdemRdMU718IA'

# Logging ayarları
logging.basicConfig(format='%(asctime)s - %(name)s - %(levelname)s', level=logging.DEBUG)

# Kullanıcı bilgileri
user_coins = {}
user_multiplier = {}
user_clicks = {}
user_rank = {}
user_purchased_multipliers = {}
user_logs = {}

# Rütbeler ve gereksinimleri
rank_requirements = {1: 0, 2: 10, 3: 20, 4: 30, 5: 50, 6: 70, 7: 100, 8: 150, 9: 200, 10: 300,
                     11: 400, 12: 500, 13: 600, 14: 700, 15: 800, 16: 900, 17: 1000, 18: 1200,
                     19: 1400, 20: 1600, 21: 2000, 22: 2500, 23: 3000, 24: 3500, 25: 4000,
                     26: 4500, 27: 5000, 28: 6000, 29: 7000, 30: 8000}

rank_names = {rank: f"Rütbe {rank}" for rank in rank_requirements}

def start(update: Update, context: CallbackContext) -> None:
    user_id = update.message.chat.id
    user_coins.setdefault(user_id, 0)
    user_multiplier.setdefault(user_id, 1)
    user_clicks.setdefault(user_id, 0)
    user_rank.setdefault(user_id, 1)
    user_purchased_multipliers.setdefault(user_id, set())
    user_logs.setdefault(user_id, [])

    show_main_menu(update)

def show_main_menu(update: Update) -> None:
    user_id = update.callback_query.from_user.id if update.callback_query else update.message.chat.id
    keyboard = [
        [InlineKeyboardButton("Oyna", callback_data='play')],
        [InlineKeyboardButton("Market", callback_data='market')],
        [InlineKeyboardButton("Profilim", callback_data='profile')],
        [InlineKeyboardButton("Rütbe Değiştir", callback_data='rank_menu')]
    ]
    reply_markup = InlineKeyboardMarkup(keyboard)
    
    if update.callback_query:
        update.callback_query.answer()  # Buton tıklamasını onayla
        update.callback_query.edit_message_text('Oyun menüsüne hoş geldiniz!', reply_markup=reply_markup)
    else:
        update.message.reply_text('Oyun menüsüne hoş geldiniz!', reply_markup=reply_markup)

def play(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    show_current_status(update)

def show_current_status(update: Update) -> None:
    user_id = update.callback_query.from_user.id
    update.callback_query.answer()  # Buton tıklamasını onayla
    keyboard = [
        [InlineKeyboardButton("Coin Kas", callback_data='collect_coin')],
        [InlineKeyboardButton("Market", callback_data='market')],
        [InlineKeyboardButton("Profilim", callback_data='profile')],
        [InlineKeyboardButton("Rütbe Değiştir", callback_data='rank_menu')],
        [InlineKeyboardButton("Ana Menü", callback_data='menu')]
    ]
    reply_markup = InlineKeyboardMarkup(keyboard)

    update.callback_query.edit_message_text(
        text=f'Oyun başladı! Coin: {user_coins[user_id]} | Çarpan: {user_multiplier[user_id]}x | Tıklama: {user_clicks[user_id]}',
        reply_markup=reply_markup
    )

def collect_coin(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    user_coins[user_id] += user_multiplier[user_id]
    user_clicks[user_id] += 1
    log_activity(user_id, "Coin toplandı")
    show_current_status(update)

def market(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    user_coins.setdefault(user_id, 0)

    keyboard = []
    multipliers = {
        2: 5,
        3: 10,
        5: 25,
        10: 50,
        15: 100,
        20: 200,
        25: 300,
        30: 400,
        35: 500,
        40: 600,
        45: 700,
    }

    for multiplier, cost in multipliers.items():
        if user_coins[user_id] >= cost and multiplier not in user_purchased_multipliers[user_id]:
            keyboard.append([InlineKeyboardButton(f"{multiplier}x Tıkla ({cost} Coin)", callback_data=f'buy_multiplier_{multiplier}')])

    keyboard.append([InlineKeyboardButton("Ana Menü", callback_data='menu')])
    reply_markup = InlineKeyboardMarkup(keyboard)

    update.callback_query.answer()  # Buton tıklamasını onayla
    update.callback_query.edit_message_text(text='Market: Satın alınabilecek özellikler:', reply_markup=reply_markup)

def buy_multiplier(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    multiplier = int(update.callback_query.data.split('_')[2])

    multipliers = {
        2: 5,
        3: 10,
        5: 25,
        10: 50,
        15: 100,
        20: 200,
        25: 300,
        30: 400,
        35: 500,
        40: 600,
        45: 700,
    }
    cost = multipliers[multiplier]

    if user_coins[user_id] >= cost:
        if multiplier not in user_purchased_multipliers[user_id]:
            user_coins[user_id] -= cost
            user_multiplier[user_id] = multiplier
            user_purchased_multipliers[user_id].add(multiplier)
            update.callback_query.edit_message_text(text=f'{multiplier}x Tıkla özelliği satın alındı! Yeni Coin: {user_coins[user_id]} | Çarpan: {user_multiplier[user_id]}x')
            log_activity(user_id, f"{multiplier}x katlayıcı satın alındı")
        else:
            update.callback_query.edit_message_text(text='Bu katlayıcıyı zaten satın aldınız!')
    else:
        update.callback_query.edit_message_text(text='Yeterli coin yok!')

    show_current_status(update)

def rank_menu(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    user_coins.setdefault(user_id, 0)

    keyboard = []
    for rank in range(1, 31):
        cost = rank_requirements[rank]
        keyboard.append(
            [InlineKeyboardButton(f"{rank_names[rank]} ({cost} Coin)", callback_data=f'buy_rank_{rank}')]
        )

    keyboard.append([InlineKeyboardButton("Ana Menü", callback_data='menu')])
    reply_markup = InlineKeyboardMarkup(keyboard)

    update.callback_query.answer()  # Buton tıklamasını onayla
    update.callback_query.edit_message_text(text='Rütbe Değiştirme Menüsü:', reply_markup=reply_markup)

def buy_rank(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    rank = int(update.callback_query.data.split('_')[2])

    cost = rank_requirements[rank]
    if user_coins[user_id] >= cost:
        user_coins[user_id] -= cost
        user_rank[user_id] = rank
        update.callback_query.edit_message_text(text=f'{rank_names[rank]} rütbesi satın alındı! Yeni Coin: {user_coins[user_id]}')
        log_activity(user_id, f"{rank_names[rank]} rütbesi satın alındı")
    else:
        update.callback_query.edit_message_text(text='Yeterli coin yok!')

    show_current_status(update)

def log_activity(user_id, activity):
    timestamp = datetime.now()
    user_logs[user_id].append((timestamp, activity))
    
    # Son 7 gün içerisindeki logları tut
    seven_days_ago = datetime.now() - timedelta(days=7)
    user_logs[user_id] = [(time, act) for time, act in user_logs[user_id] if time >= seven_days_ago]

def show_profile(update: Update, context: CallbackContext) -> None:
    user_id = update.callback_query.from_user.id
    log_messages = "\n".join([f"{time.strftime('%Y-%m-%d %H:%M:%S')}: {act}" for time, act in user_logs[user_id]])
    
    if len(user_logs[user_id]) > 10:
        file_path = f'user_logs_{user_id}.txt'
        with open(file_path, 'w') as f:
            for time, act in user_logs[user_id]:
                f.write(f"{time.strftime('%Y-%m-%d %H:%M:%S')}: {act}\n")
        
        with open(file_path, 'rb') as f:
            context.bot.send_document(chat_id=user_id, document=InputFile(f, filename=file_path))
        
        # Log dosyasını gönderdikten sonra dosyayı sil
        os.remove(file_path)

        update.callback_query.answer()  # Buton tıklamasını onayla
        update.callback_query.edit_message_text(text='Log dosyası gönderildi.')
    else:
        profile_text = (
            f"**Profil Bilgileri**\n"
            f"Toplam Coin: {user_coins[user_id]}\n"
            f"Çarpan: {user_multiplier[user_id]}x\n"
            f"Tıklama Sayısı: {user_clicks[user_id]}\n\n"
            f"**Son 7 Gün İçindeki Aktiviteler:**\n"
            f"{log_messages if log_messages else 'Hiçbir aktivite yok.'}"
        )
        
        keyboard = [
            [InlineKeyboardButton("Ana Menü", callback_data='menu')]
        ]
        reply_markup = InlineKeyboardMarkup(keyboard)

        update.callback_query.answer()  # Buton tıklamasını onayla
        update.callback_query.edit_message_text(text=profile_text, reply_markup=reply_markup)

def menu(update: Update, context: CallbackContext) -> None:
    update.callback_query.answer()  # Buton tıklamasını onayla
    show_main_menu(update)  # Ana menüyü göster

def main() -> None:
    updater = Updater(TOKEN)

    # Komutları ve geri çağırmaları işleme
    updater.dispatcher.add_handler(CommandHandler('start', start))
    updater.dispatcher.add_handler(CallbackQueryHandler(play, pattern='play'))
    updater.dispatcher.add_handler(CallbackQueryHandler(collect_coin, pattern='collect_coin'))
    updater.dispatcher.add_handler(CallbackQueryHandler(market, pattern='market'))
    updater.dispatcher.add_handler(CallbackQueryHandler(buy_multiplier, pattern='buy_multiplier_'))
    updater.dispatcher.add_handler(CallbackQueryHandler(rank_menu, pattern='rank_menu'))
    updater.dispatcher.add_handler(CallbackQueryHandler(buy_rank, pattern='buy_rank_'))
    updater.dispatcher.add_handler(CallbackQueryHandler(show_profile, pattern='profile'))

    # Botu başlat
    updater.start_polling()
    updater.idle()

if __name__ == '__main__':
    main()
