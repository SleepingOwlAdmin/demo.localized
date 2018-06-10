<?php

namespace App\Contracts;
/**
 * API UniSender.
 *
 * @link https://www.unisender.com/en/support/integration/api/
 * @link https://www.unisender.com/ru/support/integration/api/
 *
 * @method sendSms(array $params) Отправить SMS-сообщение
 * @method sendEmail(array $params) Упрощённая отправка индивидуальных email-сообщений
 * @method getLists() Получить списки рассылки с их кодами
 * @method createList(array $params) Создать новый список рассылки
 * @method updateList(array $params) Изменить свойства списка рассылки
 * @method deleteList(array $params) Удалить список рассылки
 * @method exclude(array $params) Исключить адресата из списков рассылки
 * @method unsubscribe(array $params) Отписать адресата от рассылки
 * @method importContacts(array $params) Массовый импорт и синхронизация контактов
 * @method exportContacts(array $params = array()) Экспорт всех данных контактов
 * @method getTotalContactsCount(array $params) Получить размер базы пользователя
 * @method getContactCount(array $params) Получить количество контактов в списке
 * @method createEmailMessage(array $params) Создать e-mail для массовой рассылки
 * @method createSmsMessage(array $params) Создать SMS для массовой рассылки
 * @method createCampaign(array $params) Запланировать массовую отправку e-mail или SMS сообщения
 * @method getActualMessageVersion(array $params) Получить актуальную версию письма
 * @method checkSms(array $params) Проверить статус доставки SMS
 * @method sendTestEmail(array $params) Отправка тестовых email-сообщений (на собственный адрес)
 * @method checkEmail(array $params) Проверить статус доставки email
 * @method updateOptInEmail(array $params) Изменить текст письма со ссылкой подтверждения подписки
 * @method getWebVersion(array $params) Получить ссылку на веб-версию отправленного письма
 * @method deleteMessage(array $params) Удалить сообщение
 * @method createEmailTemplate(array $params) Создать шаблон сообщения для массовой рассылки
 * @method updateEmailTemplate(array $params) Редактировать существующий шаблон сообщения
 * @method deleteTemplate(array $params) Удалить шаблон
 * @method getTemplate(array $params) Получение информации о шаблоне
 * @method getTemplates(array $params = array()) Получить список всех шаблонов, созданных в системе
 * @method listTemplates(array $params = array()) Получить список всех шаблонов без body
 * @method getCampaignDeliveryStats(array $params) Получить отчёт о статусах доставки сообщений для заданной рассылки
 * @method getCampaignCommonStats(array $params) Получить общие сведения о результатах доставки для заданной рассылки
 * @method getVisitedLinks(array $params) Получить статистику переходов по ссылкам
 * @method getCampaigns(array $params = array()) Получить список рассылок
 * @method getCampaignStatus(array $params) Получить статус рассылки
 * @method getMessages(array $params = array()) Получить список сообщений
 * @method getMessage(array $params) Получение информации об SMS или email сообщении
 * @method listMessages(array $params) Получить список сообщений без тела и вложений
 * @method getFields() Получить список пользовательских полей
 * @method createField(array $params) Создать новое поле
 * @method updateField(array $params) Изменить параметры поля
 * @method deleteField(array $params) Удалить поле
 * @method getTags() Получить список пользовательских меток
 * @method deleteTag(array $params) Удалить метку
 */
interface Unisender
{

}