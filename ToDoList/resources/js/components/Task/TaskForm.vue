<template>
    <div class="popup-form">
        <div>
            <div>
                <h3> {{formTitle()}} Task</h3>
                <button class="overlay" @click="closeForm">{{ $t('close') }}</button>
            </div>

            <DynamicFields :schema="formSchema" :submit-text="formTitle()" @onSubmit="handleSubmit">
                <template v-slot:selection>
                    <SelectCategory :categories="categories" @onSelect="selectedCategory"/>
                </template>
            </DynamicFields>

        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import * as Yup from "yup";
import DynamicFields from "../DynamicFields.vue";
import SelectCategory from '../SelectCategory.vue';
import '../../../scss/TaskForm.scss';

export default {
    components: { DynamicFields, SelectCategory },
    props: {
        taskData: {
            type: Object,
            default: () => ({
                id: null,
                title: null,
                description: null,
                deadline: Date.now(),
                category_id: null,
                status: null,
            }),
        },
        isUpdate: {
            type: Boolean,
            default: false,
        },
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            category: this.taskData.category_id || null,
        };
    },
    computed: {
        formSchema() {
            const fields = [
                {
                    label: 'Task Title',
                    name: 'title',
                    as: 'input',
                    value: this.taskData.title,
                    rules: Yup.string().required(),
                },
                {
                    label: 'Task Description',
                    name: 'description',
                    as: 'input',
                    value: this.taskData.description,
                    rules: Yup.string().required(),
                },
                {
                    label: 'Task Deadline',
                    name: 'deadline',
                    type: 'date',
                    as: 'input',
                    value: this.taskData.deadline,
                    rules: Yup.string().required(),
                },
            ];

            // Conditionally add the status field only for task creation
            if (!this.isUpdate) {
                fields.push({
                    label: 'Task Status',
                    name: 'status',
                    as: 'select',
                    type: 'string',
                    options: [
                        { text: 'Not Started', value: 'Not Started' },
                        { text: 'In Progress', value: 'In Progress' },
                        { text: 'Done', value: 'Done' },
                    ],
                    value: this.taskData.status,
                });
            }

            return { fields };
        },
    },
    methods: {
        ...mapActions({
            createTask: 'task/createTask',
            updateTask: 'task/updateTask',
        }),
        handleSubmit(data) {
            if (this.category === null) return;

            const formData = new FormData();
            formData.append('title', data.title);
            formData.append('description', data.description);
            formData.append('deadline', data.deadline);
            formData.append('category_id', this.category);

            if (!this.isUpdate) {
                formData.append('status', data.status);
            }

            if (this.isUpdate) {
                formData.append("_method", "PUT");
                this.updateTask({ id: this.taskData.id, task: formData }).then(() => {
                    this.closeForm();
                });
            } else {
                this.createTask(formData).then(() => {
                    this.closeForm();
                });
            }
        },
        closeForm() {
            this.$emit('closeForm');
            this.$router.push({ name: 'ListOfTasks' });
        },
        formTitle() {
            return this.isUpdate ? 'Update' : 'Create';
        },
        selectedCategory(id) {
            this.category = id;
        },
    },
};

</script>
