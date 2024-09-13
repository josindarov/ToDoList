import { createI18n } from 'vue-i18n';

const messages = {
    en: {
        createTask: 'Create Task',
        title: 'Title',
        description: 'Description',
        action: 'Action',
        deadline: 'Deadline'

    },
    ru: {
        createTask: 'Создать задачу',
        title: 'Заголовок',
        description: 'описание',
        action: 'Действие',
        deadline: 'Крайний срок'
    },
};

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages,
});

export default i18n;
