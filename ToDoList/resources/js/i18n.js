import { createI18n } from 'vue-i18n';

const messages = {
    en: {
        createTask: 'Create Task',
        title: 'Title',
        description: 'Description',
        action: 'Action',
        deadline: 'Deadline',
        downloadFail: 'Failed to download the file',
        download: 'Download',
        close: 'Close',
        selectFile: 'Select Excel file:',
        upload: 'Upload',
        email: 'Email:',
        password: 'Password',
        login: 'Login',
        register: 'Register',
        confirmPassword: 'Confirm Password',
        notStarted: 'Not Started',
        inProgress: 'In Progress',
        done: 'Done'
    },
    ru: {
        createTask: 'Создать задачу',
        title: 'Заголовок',
        description: 'описание',
        action: 'Действие',
        deadline: 'Крайний срок',
        downloadFail: 'Не удалось загрузить файл',
        download: 'Скачать',
        close: 'Закрывать',
        selectFile: 'Выберите файл Excel:',
        upload: 'Загрузить',
        email: 'Электронная почта',
        password: 'Пароль',
        login: 'Авторизоваться',
        register: 'Зарегистрироваться',
        confirmPassword: 'Подтвердите пароль',
        notStarted: 'Не начато',
        inProgress: 'В ходе выполнения',
        done: 'Сделанный'
    },
};

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages,
});

export default i18n;
