<script setup>
    import { useForm } from "@inertiajs/vue3";
    import TextInput from "@/Components/TextInput.vue";

    const props = defineProps({
        user_contact:{type:Object, default:() => ({})},
        modal:String,
        title:String,
        op:String
    });

    const form = useForm({
        id:props.user_contact.id, 
        name:props.user_contact.name,
        email:props.user_contact.email,
        subject:props.user_contact.subject,
        message:props.user_contact.message
    });

    const save = () => {
        form.post(route('user_contact.store'), {
            onSuccess: () => cerrar()
        });
    }

    const update = () => {
        let id = document.getElementById('id2').value;
        form.put(route('user_contact.update', id), {
            onSuccess: () => cerrar()
        });
    }

    const cerrar = () => {
        form.reset();
        document.querySelector('#cerrar'+props.op).click();
    }

</script>
<template>
    <div class="modal fade" :id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="h5">{{ title }}</label>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <form @submit.prevent="(op === '1' ? save() : update())">
                        <TextInput :id="'id'+op" type="hidden" name="id" v-model="form.id">
                        </TextInput>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                            <TextInput :id="'name'+op" class="form-control" type="text" name="name" v-model="form.name" maxlength="120" placeholder="Nombre" required>
                            </TextInput>
                        </div>
                        <div v-if="form.errors.name" class="text-sm text-danger">
                            {{ form.errors.name }}
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-envelope fa-beat"></i></span>
                            <TextInput :id="'email'+op" class="form-control" type="text" name="email" v-model="form.email" maxlength="100" placeholder="Correo electrónico" required>
                            </TextInput>
                        </div>
                        <div v-if="form.errors.email" class="text-sm text-danger">
                            {{ form.errors.email }}
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-file-lines fa-beat"></i></span>
                            <TextInput :id="'subject'+op" class="form-control" type="text" name="subject" v-model="form.subject" maxlength="100" placeholder="Asunto" required>
                            </TextInput>
                        </div>
                        <div v-if="form.errors.subject" class="text-sm text-danger">
                            {{ form.errors.subject }}
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-comments fa-beat"></i></span>
                            <TextInput :id="'message'+op" class="form-control" type="text" name="message" v-model="form.message" maxlength="120" placeholder="Mensaje" required>
                            </TextInput>
                        </div>
                        <div v-if="form.errors.message" class="text-sm text-danger">
                            {{ form.errors.message }}
                        </div>
                        <div class="d-grid mx-auto">
                            <button class="btn btn-success" :disabled="form.processing">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" type="submit" :id="'cerrar'+op" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>
    </div>
</template>
