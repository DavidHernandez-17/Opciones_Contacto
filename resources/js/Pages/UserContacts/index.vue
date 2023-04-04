<template>
    <Head title="Contacto"></Head>
    <AuthenticatedLayout>
        <template #header>
            <div class="container-fluid mt-3 bg-white">
                <div class="row mt-3">
                    <div class="col-md-4 offset-md-4">
                        <div class="d-grid mx-auto">
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreate">
                                <i class="fa-solid fa-cicle-plus"></i>Añadir
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="table-resposive">
                            <table class="table table-stripeted table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Correo Electrónico</th>
                                        <th>Asunto</th>
                                        <th>Mensaje</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user_contact, i in user_contacts" :key="user_contact.id">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ user_contact.name }}</td>
                                        <td>{{ user_contact.email }}</td>
                                        <td>{{ user_contact.subject }}</td>
                                        <td>{{ user_contact.message }}</td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" @click="eliminar(user_contact.id, user_contact.subject)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Swal from 'sweetalert2';
    import { Head } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({});
    const props = defineProps({
        user_contacts:{type:Object}
    });

    const eliminar = (id, subject) =>{
        const swalWithBootstrapButtons = Swal.mixin({
            buttonsStyling:true
        })
        swalWithBootstrapButtons.fire({
            title: '¿Seguro que desea eliminar la novedad ' + subject + '?',
            text: 'Se perderá la novedad',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar',
            confirmButtonColor:'#1C6E19',
            cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.delete(route('user_contact.destroy', id))
            }
        }).catch((err) => {
            
        });
    }

</script>