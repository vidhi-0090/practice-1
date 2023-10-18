<template>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <button
                id="show-modal"
                @click="showModal = true"
                class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                Add Notes
            </button>
            <br />
            <br />

            <div>
                <table class="display" id="example" style="width: 100%">
                    <thead>
                        <tr style="border: 1px solid black">
                            <th
                                style="
                                    border: 1px solid black;
                                    padding: 10px;
                                    width: 5%;
                                "
                            >
                                Notes Id
                            </th>
                            <th style="border: 1px solid black; padding: 10px">
                                Notes
                            </th>
                            <th
                                style="
                                    border: 1px solid black;
                                    padding: 10px;
                                    width: 15%;
                                "
                            >
                                Date
                            </th>

                            <th
                                style="
                                    border: 1px solid black;
                                    padding: 10px;
                                    width: 14%;
                                "
                            >
                                <span>Action</span>
                            </th>
                        </tr>
                    </thead>

                    <TransitionGroup name="slide-fade" tag="tbody">
                        <tr
                            v-for="(data, index) in getNotes"
                            :key="data.id"
                            style="border: 1px solid black; width: 100%"
                        >
                            <td
                                style="
                                    border: 1px solid black;
                                    padding: 5px;
                                    text-align: center;
                                "
                            >
                                {{ index + 1 }}
                            </td>

                            <td style="border: 1px solid black; padding: 5px">
                                {{ data.notes }}
                            </td>
                            <td
                                style="
                                    border: 1px solid black;
                                    padding: 5px;
                                    text-align: center;
                                "
                            >
                                {{ data.dateTime }}
                            </td>
                            <td style="border: 1px solid black; padding: 10px">
                                <button
                                    id="show-modal"
                                    @click="modalOpen((id = data.id))"
                                    style="margin: 5px 5px"
                                    class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="deleteNotes((noteId = data.id))"
                                    style="margin: 5px 5px"
                                    class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </TransitionGroup>
                </table>
            </div>
        </div>
    </main>

    <Teleport to="body">
        <modal :show="showModal" @close="showModal = false" id="showModel">
            <template #header>
                <button
                    type="button"
                    style="
                        float: right;
                        border: 1px solid #cccccc;
                        padding: 8px 10px;
                    "
                    @click="closeModal()"
                >
                    X
                </button>
            </template>
            <template #body>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="form_wrapper">
                        <div class="form_container">
                            <div class="title_container">
                                <h2>Add Notes</h2>
                            </div>
                            <div class="row clearfix">
                                <div>
                                    <p v-if="success">{{ success }}</p>
                                    <form @submit.prevent="saveNotes()">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="address-card"
                                            /></span>
                                            <textarea
                                                type="text"
                                                name="notes"
                                                placeholder="notes"
                                                v-model="notes"
                                                style="height: 70px"
                                            ></textarea>
                                            <p style="color: red" id="notes">
                                                {{ errors.notes }}
                                            </p>
                                        </div>

                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="calendar"
                                            /></span>
                                            <input
                                                type="date"
                                                name="dateTime"
                                                placeholder="dateTime"
                                                v-model="dateTime"
                                            />
                                            <p style="color: red" id="dateTime">
                                                {{ errors.dateTime }}
                                            </p>
                                        </div>

                                        <input
                                            class="button"
                                            type="submit"
                                            value="Submit"
                                        />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </modal>

        <modal
            :show="showEditModal"
            @close="showEditModal = false"
            id="showEditModal"
        >
            <template #header>
                <button
                    type="button"
                    style="
                        float: right;
                        border: 1px solid #cccccc;
                        padding: 8px 10px;
                    "
                    @click="closeModal()"
                >
                    X
                </button>
            </template>
            <template #body>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="form_wrapper">
                        <div class="form_container">
                            <div class="title_container">
                                <h2>Edit Notes</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="">
                                    <p
                                        style="color: red"
                                        v-for="error in success"
                                        :key="error"
                                    >
                                        <span v-for="err in error" :key="err">
                                            {{ err }}
                                        </span>
                                    </p>
                                    <form @submit.prevent="editNotes()">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="certificate"
                                            /></span>
                                            <input
                                                type="hidden"
                                                name="id"
                                                placeholder="editId"
                                                v-model="editId"
                                                readonly
                                            />
                                        </div>

                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon icon="book"
                                            /></span>
                                            <textarea
                                                type="text"
                                                name="notes"
                                                placeholder="Notes"
                                                v-model="editNote"
                                                style="height: 70px"
                                            ></textarea>
                                            <p style="color: red" id="name">
                                                {{ errors.notes }}
                                            </p>
                                        </div>
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="address-card"
                                            /></span>
                                            <input
                                                type="date"
                                                name="dateTime"
                                                placeholder="editDateTime"
                                                v-model="editDateTime"
                                            />
                                            <p
                                                style="color: red"
                                                id="description"
                                            >
                                                {{ errors.dateTime }}
                                            </p>
                                        </div>

                                        <input
                                            class="button"
                                            type="submit"
                                            value="Submit"
                                        />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </modal>
    </Teleport>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import { inject } from "vue";
import { useRouter } from "vue-router";
import notesStore from "../store/notes.js";
import axios from "axios";
import Modal from "../components/Modal.vue";
import Swal from "sweetalert2";

const baseUrl = inject("baseUrl");
const router = useRouter();
const user_id = ref(0);
const showModal = ref(false);
const showEditModal = ref(false);
const notes = ref("");
const dateTime = ref("");
const editId = ref("");
const editNote = ref("");
const editDateTime = ref("");
const success = ref("");
const errors = reactive({
    notes: "",
    dateTime: "",
});
const notesPattern = /\S+/;

const getUserId = async () => {
    try {
        const user_data = await axios.get(baseUrl.value + "api/users");
        user_id.value = user_data.data.data.id;
    } catch (error) {
        console.log(error);
    }
};

const closeModal = async () => {
    showModal.value = false;
};

const saveNotes = async () => {
    try {
        errors.notes = "";

        const currentDatetime = new Date();
        const selectedDatetime = new Date(dateTime.value);

        if (!notesPattern.test(notes.value)) {
            errors.notes = "Notes must not be empty.";
            return;
        }

        if (selectedDatetime <= currentDatetime) {
            errors.dateTime = "Date and time must be in the future.";
            return;
        } else {
            errors.dateTime = "";
        }

        let existingNotes = JSON.parse(localStorage.getItem("notesData"));

        if (!Array.isArray(existingNotes)) {
            existingNotes = [];
        }

        const response = await axios.post(baseUrl.value + "api/notes", {
            notes: notes.value,
            dateTime: dateTime.value,
        });
        if (response.data.status === true) {
            const newNote = {
                notes: notes.value,
                dateTime: dateTime.value,
                userId: user_id.value,
                id: response.data.data.id,
            };

            existingNotes.push(newNote);

            localStorage.setItem("notesData", JSON.stringify(existingNotes));
            success.value = response.data.message;
            showModal.value = false;
            Swal.fire({
                icon: "success",
                title: "Add Notes Successful",
                showConfirmButton: true,
            });
            notesStore.dispatch("getNotes");
        } else {
            console.log(response);
            const responseErrors = response.data.message;
            for (const field in responseErrors) {
                if (field in errors) {
                    errors[field] = responseErrors[field][0];
                }
            }
        }
        notesStore.dispatch("getNotes");
    } catch (error) {
        console.log(error);
    }
};

const deleteNotes = async (noteId) => {
    try {
        const result = await Swal.fire({
            title: "Delete Note",
            text: "Are you sure you want to delete this note?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1f2937",
            cancelButtonColor: "#99a9c0",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        });

        if (result.isConfirmed) {
            try {
                const res = await axios.delete(
                    baseUrl.value + "api/notes/" + noteId
                );
                if (res.data.status === true) {
                    let existingNotes = JSON.parse(
                        localStorage.getItem("notesData")
                    );
                    existingNotes = existingNotes.filter(
                        (note) => note.id !== noteId
                    );
                    localStorage.setItem(
                        "notesData",
                        JSON.stringify(existingNotes)
                    );
                    Swal.fire({
                        icon: "success",
                        title: "Successful Delete Note",
                        showConfirmButton: true,
                        // timer: 1500,
                    });
                    notesStore.dispatch("getNotes");
                }
            } catch (error) {}
        }
    } catch (error) {}
};

const modalOpen = async (id) => {
    try {
        const res = await axios.get(baseUrl.value + "api/notes/" + id);
        console.log(res);
        editId.value = res.data.data.id;
        editNote.value = res.data.data.notes;
        editDateTime.value = res.data.data.dateTime;

        showEditModal.value = true;
    } catch (error) {}
};

const editNotes = async () => {
    try {
        errors.notes = "";

        if (!notesPattern.test(editNote.value)) {
            errors.notes = "Notes must not be empty.";
            return;
        }

        const currentDatetime = new Date();
        const selectedDatetime = new Date(editDateTime.value);
        if (selectedDatetime <= currentDatetime) {
            errors.dateTime = "Date and time must be in the future.";
            return;
        } else {
            errors.dateTime = "";
        }

        let existingNotes = JSON.parse(localStorage.getItem("notesData"));

        if (!Array.isArray(existingNotes)) {
            existingNotes = [];
        }

        const response = await axios.put(
            baseUrl.value + "api/notes/" + editId.value,
            {
                notes: editNote.value,
                dateTime: editDateTime.value,
            }
        );

        if (response.data.status === true) {
            const noteIndex = existingNotes.findIndex(
                (note) => note.id === editId.value
            );

            if (noteIndex !== -1) {
                existingNotes[noteIndex].notes = editNote.value;
                existingNotes[noteIndex].dateTime = editDateTime.value;
            }
            localStorage.setItem("notesData", JSON.stringify(existingNotes));

            showEditModal.value = false;
            Swal.fire({
                icon: "success",
                title: "Edit Note Successful",
                showConfirmButton: true,
            });
        } else {
            console.log(response);
            const responseErrors = response.data.message;
            for (const field in responseErrors) {
                if (field in errors) {
                    errors[field] = responseErrors[field][0];
                }
            }
        }
        notesStore.dispatch("getNotes");
    } catch (error) {
        console.log(error);
    }
};

const getNotes = computed(() => {
    return notesStore.getters.getNotes;
});

onMounted(() => {
    getUserId();
    notesStore.dispatch("getNotes");
});
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
.status-true-class {
    width: 50%;
    text-align: center;
    border: 1px solid #427b35;
    border-radius: 5px;
    background-color: #427b35;
    color: white;
}

.status-false-class {
    width: 50%;
    text-align: center;
    border: 1px solid #9b2925;
    border-radius: 5px;
    background-color: #9b2925;
    color: white;
}

.slide-fade-leave-active,
.slide-fade-enter-active {
    transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
    // transition: transform 1.3s ease-out, opacity 1.3s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: scaleY(0.01) translate(30px, 0);
}

.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}

.slide-fade-leave-active {
    position: absolute;
}
</style>
