<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3">
            <h1 class="text-center text-2xl text-80 font-light mb-3">
                Pending Appointment: <span class="text-3xl">{{ card.total }}</span>
            </h1>
            <a href="/admin/resources/appointments" class="no-underline text-black font-bold float-right">📅VIEW</a>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card'
    ],

    mounted() {
        //
    },
}
</script>
