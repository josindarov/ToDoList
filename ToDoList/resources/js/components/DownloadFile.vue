<template>
    <div>
        <button class="download-button" @click="downloadFile">Download</button>
    </div>
</template>

<script>
import axiosInstance from "../axiosInstance";
import '../../scss/DataTable.scss'

export default {
    methods: {
        async downloadFile() {
            try {
                const response = await axiosInstance.get('/tasks/download', {
                    responseType: 'blob',
                });
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'tasks.xlsx'); // Filename
                document.body.appendChild(link);
                link.click();
            } catch (error) {
                alert('Failed to download the file');
            }
        },
    },
};
</script>


