<template>
    <div>
        <heading class="mb-6">Import Csv</heading>

        <card class="p-6">
            <div class="mb-4 flex">
                <span class="mr-3">Format:</span>
                <pre>starts_at,ends_at<br>1/11/2019 13:20,1/11/2019 14:00<br>2/11/2019 13:20,2/11/2019 14:00</pre>
            </div>

            <form method="POST" enctype="multipart/form-data" @submit.prevent="submit">
                <div class="mb-6">
                    <input type="file" id="uploadFile" required>
                </div>
                <button class="border px-4 py-2 hover:bg-black hover:text-white uppercase">Submit</button>
            </form>
        </card>
    </div>
</template>

<script>
export default {
    methods: {
        submit() {
            const form = new FormData()
            const file = document.querySelector('#uploadFile').files[0]
            form.append('csv', file)
            axios.post('/nova-vendor/import-csv/upload-csv', form, {'Content-Type': 'multipart/form-data'})
                .then(res => {
                    window.location.replace('/admin/resources/appointments')
                })
            return false
        }
    }
};
</script>

<style>
/* Scoped Styles */
</style>
