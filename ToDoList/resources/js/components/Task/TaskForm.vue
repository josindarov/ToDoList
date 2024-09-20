<template>
    <div class="popup-form">
        <div>
            <div>
                <h3> {{formTitle()}} Task</h3>
                <button class="overlay" @click="closeForm">{{ $t('close') }}</button>
            </div>

            <DynamicFields :schema="formSchema" :submit-text="formTitle()" @onSubmit="handleSubmit">

            </DynamicFields>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import * as Yup from "yup";
import DynamicFields from "../DynamicFields.vue";
import '../../../scss/TaskForm.scss'
export default {
    components: {DynamicFields},
    props: {
        taskData: {
            type: Object,
            default: () => ({
                id:null,
                title: null,
                description: null,
                deadline: Date.now(),
                category_id: null,
                status: null
            }),
        },

        isUpdate: {
            type: Boolean,
            default: false,
        }
    },

    data() {
        return {
            formSchema: {
                fields: [
                    {
                    label: 'Task Title',
                    name: 'title',
                    as: 'input',
                    value: this.taskData.title,
                    rules: Yup.string().required()
                    },
                    {
                        label: 'Task Description',
                        name: 'description',
                        as: 'input',
                        value: this.taskData.description,
                        rules: Yup.string().required()
                    },
                    {
                        label: 'Task Deadline',
                        name: 'deadline',
                        type: 'date',
                        as: 'input',
                        value: this.taskData.deadline,
                        rules: Yup.string().required()
                    },
                    {
                        label: 'Task Category',
                        name: 'category_id',
                        type: 'number',
                        as: 'select',
                        options: [
                            {text: 'Personal', value: 1 },
                            { text: 'Work', value: 2 },
                            { text: 'Team', value: 3 }
                        ],
                        value: this.taskData.category_id
                    },
                    {
                        label: 'Task Status',
                        name: 'status',
                        type: 'number',
                        as: 'select',
                        options: [
                            {text: 'Not Started', value: 1 },
                            { text: 'In Progress', value: 2 },
                            { text: 'Done', value: 3 }
                        ],
                        value: this.taskData.status
                    }
                ]
            }
        }
    },

    methods: {
        ...mapActions({
            createTask: 'task/createTask',
            updateTask: 'task/updateTask',
            fetchTask: 'task/fetchTask',
        }),

        handleSubmit(data) {
            const formData = new FormData();

            formData.append('title', data.title);
            formData.append('description', data.description);
            formData.append('deadline', data.deadline);
            formData.append('category_id', data.category_id);
            formData.append('status', data.status);

            if(this.isUpdate){
                formData.append("_method", "PUT")
                this.updateTask({id: this.taskData.id, task: formData}).then(() => {
                    this.closeForm()
                })
            }else{
                this.createTask(formData).then(() => {
                    this.closeForm();
                })
            }
        },

        closeForm(){
            this.$emit('closeForm');
            this.$router.push({name: "ListOfTasks"})
        },

        formTitle() {
            return this.isUpdate ? 'Update' : 'Create'
        }
    }
}
</script>

