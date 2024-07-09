<template>
<Head title="Dashboard" />
<AuthenticatedLayout>
    <template #header>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                :href="route('tasks.create')"
                            >
                                Create Task
                            </Link>
                        </div>
                        <table className="table-fixed w-full">
                            <thead>
                                <tr className="bg-gray-100">
                                    <th className="px-4 py-2 w-20">No.</th>
                                    <th className="px-4 py-2">Название</th>
                                    <th className="px-4 py-2">Описание</th>
                                    <th className="px-4 py-2">Статус</th>
                                    <th className="px-4 py-2">Выбор</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in tasks">

                                    <td className="border px-4 py-2">{{ task.id }}</td>
                                    <td className="border px-4 py-2">{{ task.name }}</td>
                                    <td className="border px-4 py-2">{{ task.description }}</td>
                                    <td className="border px-4 py-2">{{ task.status }}</td>
                                    <td className="border px-4 py-2">
                                        <Link
                                            tabIndex="1"
                                            className="mx-1 px-4 py-2.5 text-sm text-white bg-blue-500 rounded"
                                            :href="route('tasks.edit', task.id)"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="completeTask(task.id)"
                                            tabIndex="-1"
                                            type="button"
                                            className="mx-1 px-4 py-2 text-sm text-white bg-green-500 rounded"
                                        >
                                            Done
                                        </button>
                                        <button
                                            @click="destroy(task.id)"
                                            tabIndex="-1"
                                            type="button"
                                            className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                        >
                                            Delete
                                        </button>
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '/home/pavel/laravel/CRUD APP/app/resources/js/Layouts/AuthenticatedLayout.vue';
///import BreezeLabel from '@/Components/Label.vue';
///import BreezeInput from '@/Components/Input.vue';
///import BreezeTextArea from '@/Components/Textarea.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    tasks: Array,
});
const form = useForm({

});
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('tasks.destroy', id));
    }
}
function completeTask(id){
           form.patch(route('tasks.complete', id));
    
}

</script>