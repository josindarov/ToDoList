<template>
    <div class="upload-container">
        <form @submit.prevent="submitForm" class="file-upload-form">
            <div class="file-input-container">
                <label for="file">Select Excel File:</label>
                <input type="file" id="file" @change="handleFileChange" />
                <button type="submit" class="upload-btn">Upload</button>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import axiosInstance from "../axiosInstance";
import { mapActions } from "vuex";
import '../../scss/DataTable.scss'
import '../../scss/FileForm.scss'

export default {
    data() {
        return {
            formData: {
                file: null,
            },
            errors: {},
        };
    },

    mounted() {
        this.createFormValidation();
    },

    methods: {
        ...mapActions({ fetchTasks: 'task/fetchTasks' }),

        createFormValidation() {
            const schema = yup.object({
                file: yup
                    .mixed()
                    .required('File is required')
                    .test('fileType', 'Only Excel files are allowed', (value) => {
                        return (
                            value &&
                            (value.type ===
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
                                value.type === 'application/vnd.ms-excel')
                        );
                    }),
            });

            const { setFieldValue, errors} = useForm({
                validationSchema: schema,
            });

            this.errors = errors;
            this.setFieldValue = setFieldValue;
        },

        handleFileChange(event) {
            const file = event.target.files[0];
            this.setFieldValue('file', file);
            this.formData.file = file;
        },

        async submitForm() {
            const formData = new FormData();
            formData.append('file', this.formData.file);

            try {
                await axiosInstance.post('/tasks/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                alert('File uploaded successfully');

                await this.fetchTasks();
            } catch (error) {
                alert('Failed to upload the file');
            }
        },
    },
};
</script>

