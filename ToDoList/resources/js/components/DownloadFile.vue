<template>
    <div>
        <button class="download-button" @click="downloadFile">{{$t('download')}}</button>
    </div>
</template>

<script>
import axiosInstance from "../axiosInstance";
import '../../scss/DataTable.scss'
import {saveAs} from 'file-saver';

export default {
    methods: {
        async downloadFile() {
            try {
                await axiosInstance.get('/tasks/download', {
                    responseType: "blob",
                }).then(response => {
                    saveAs(response.data, 'task.xlsx');
                })

            } catch (error) {
                alert($t('downloadFail'));
            }
        },
    },
};
</script>


