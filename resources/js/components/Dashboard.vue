<template>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Welcome to the Dashboard
            </h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>User ID: {{ $route.params.user_id }}</p>
            <p>User Name: {{ username }}</p>
            <p>User Email: {{ email }}</p>
            <br />
            <button
                style="float: right"
                class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                Change Password
            </button>
            <button
                id="show-modal"
                @click="showModal = true"
                class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                Add Books
            </button>
            <br />
            <br />
            <!-- <p style="color: red" v-for="error in searchRequired" :key="error">
                <span v-for="err in error" :key="err">
                    {{ err }}
                </span>
            </p> -->
            <div class="select_option">
                <select
                    id="book-Pages"
                    style="float: right"
                    placeholder="Sort By Pages"
                >
                    <option disabled>Filters</option>
                    <option selected value="5">Show All Data</option>
                    <option value="1">More Than 100 Pages</option>
                    <option value="2">Less Than 90 & More Than 25 Pages</option>
                    <option value="3">
                        Less Than 90 & More Than 25 But Not 80 Pages
                    </option>
                    <option value="4">00 Pages Books</option>
                    <option value="6">Released Year 2015 & 2001</option>
                    <option value="7">Sort By Category</option>
                    <option value="8">Sort By Released Year</option>
                    <option value="9">Sort By Book Author</option>
                    <option value="10">Sort By Book Price</option>
                </select>
            </div>
            <input
                @keyup="searchData()"
                type="search"
                placeholder="Search"
                v-model="search"
            />
            <!-- <button
                @click="searchData()"
                style="background-color: #212529"
                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                Search
            </button> -->
            <br />
            <br />

            <table class="display" id="example" style="width: 100%">
                <thead>
                    <tr style="border: 1px solid black">
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Name
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Description
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            No.Of Page
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Author
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Category
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Price
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Released Year
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            Book Status
                        </th>
                        <th
                            scope="col"
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            <span class="">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="acc acg">
                    <p
                        style="color: red"
                        v-for="error in searchDataNotFound"
                        :key="error"
                    >
                        <span v-for="err in error" :key="err">
                            {{ err }}
                        </span>
                    </p>

                    <!-- <tr
                        class=""
                        v-for="data in bookData.value"
                        :key="data"
                        style="border: 1px solid black"
                    > -->
                    <tr
                        class=""
                        v-for="data in collection"
                        :key="data"
                        style="border: 1px solid black"
                    >
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.name }}
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.description }}
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.no_of_page }}
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.author }}
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.category }}
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.price }}
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 5px"
                        >
                            {{ data.released_year }}
                        </td>
                        <td style="border: 1px solid black; padding: 5px">
                            <p
                                :class="{
                                    'status-true-class': data.status === 'True',
                                    'status-false-class':
                                        data.status === 'False',
                                }"
                            >
                                {{ data.status }}
                            </p>
                        </td>
                        <td
                            class=""
                            style="border: 1px solid black; padding: 10px"
                        >
                            <button
                                id="show-modal"
                                @click="modalOpen((id = data.id))"
                                style="margin: 5px 5px"
                                class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Edit
                            </button>
                            <button
                                id="show-modal"
                                @click="modalDelete((id = data.id))"
                                style="margin: 5px 5px"
                                class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- <ul>
                <li v-for="item in collection" :key="item">{{ item.name }}</li>
            </ul> -->

            <div>
                <button
                    class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                    v-for="page in pagination.pages"
                    :key="page"
                    @click="setPage(page)"
                    style="margin-right: 2px; margin-top: 2px"
                >
                    {{ page }}
                </button>
            </div>

            <br />
            <br />
            <br />
            <div class="select_option">
                <select id="bookPages" placeholder="Filters">
                    <option disabled>Filters</option>
                    <option selected value="5">Show All Data</option>
                    <option value="1">More Than 100 Pages</option>
                    <option value="2">Less Than 90 & More Than 25 Pages</option>
                    <option value="3">
                        Less Than 90 & More Than 25 But Not 80 Pages
                    </option>
                    <option value="4">00 Pages Books</option>
                    <option value="6">Released Year 2015 & 2001</option>
                    <option value="7">Sort By Category</option>
                    <option value="8">Sort By Released Year</option>
                    <option value="9">Sort By Book Author</option>
                    <option value="10">Sort By Book Price</option>
                </select>
            </div>
            <!-- <select
                id="bookPages"
                class="bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
                <option disabled>Show By Pages</option>
                <option value="1">More Than 100 Pages</option>
                <option value="2">Less Than 90 & More Than 25 Pages</option>
                <option value="3">
                    Less Than 90 & More Than 25 But Not 80 Pages
                </option>
                <option value="4">00 Pages Books</option>
                <option value="5">Show All Data</option>
                <option value="6">Released Year 2015 & 2001</option>
            </select> -->
            <br />

            <div>
                <table
                    id="book-datatable"
                    class="table table-bordered bookDatatable"
                    style="width: 100%"
                >
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Description</th>
                            <th>No. Of Page</th>
                            <th>Book Author</th>
                            <th>Book Category</th>
                            <th>Book Price</th>
                            <th>Released Year</th>
                            <th>Book Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>

    <Teleport to="body">
        <!-- use the modal component, pass in the prop -->
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
                                <h2>Add Book-Data</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="">
                                    <p
                                        style="color: red"
                                        v-for="error in errors"
                                        :key="error"
                                    >
                                        <!-- {{ error }} -->
                                        <span v-for="err in error" :key="err">
                                            {{ err }}
                                        </span>
                                    </p>
                                    <form @submit.prevent="saveData()">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon icon="book"
                                            /></span>
                                            <input
                                                type="text"
                                                name="name"
                                                placeholder="Name"
                                                v-model="form.name"
                                            />
                                            <p style="color: red" id="name"></p>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="folder-open"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="no_of_page"
                                                        v-model="
                                                            form.no_of_page
                                                        "
                                                        placeholder="No. Of Page"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="no_of_page"
                                                    ></p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="user"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="author"
                                                        v-model="form.author"
                                                        placeholder="Author"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="author"
                                                    ></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="bars"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="category"
                                                        v-model="form.category"
                                                        placeholder="Category"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="category"
                                                    ></p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="inr"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="price"
                                                        v-model="form.price"
                                                        placeholder="Price"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="price"
                                                    ></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="calendar"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="released_year"
                                                        v-model="
                                                            form.released_year
                                                        "
                                                        placeholder="Released Year"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="released_year"
                                                    ></p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <lable style="color:#6e7582;"
                                                        >Status</lable
                                                    >
                                                    <label
                                                        style="
                                                            margin-left: 10px;
                                                        "
                                                        class="relative inline-flex items-center mb-5 cursor-pointer"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            value="true"
                                                            class="sr-only peer"
                                                            name="status"
                                                            v-model="
                                                                form.status
                                                            "
                                                        />
                                                        <div
                                                            class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-gray-800"
                                                        ></div>
                                                        <span
                                                            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                        ></span>
                                                    </label>

                                                    <p
                                                        style="color: red"
                                                        id="status"
                                                    ></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="address-card"
                                            /></span>
                                            <input
                                                type="text"
                                                name="description"
                                                placeholder="description"
                                                v-model="form.description"
                                            />
                                            <p
                                                style="color: red"
                                                id="description"
                                            ></p>
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
                                <h2>Edit Book-Data</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="">
                                    <p
                                        style="color: red"
                                        v-for="error in errors"
                                        :key="error"
                                    >
                                        <!-- {{ error }} -->
                                        <span v-for="err in error" :key="err">
                                            {{ err }}
                                        </span>
                                    </p>
                                    <form @submit.prevent="editData()">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="certificate"
                                            /></span>
                                            <input
                                                type="text"
                                                name="bookId"
                                                placeholder="bookId"
                                                v-model="bookId"
                                                readonly
                                            />
                                            <p
                                                style="color: red"
                                                id="bookId"
                                            ></p>
                                        </div>

                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon icon="book"
                                            /></span>
                                            <input
                                                type="text"
                                                name="name"
                                                placeholder="Name"
                                                v-model="editName"
                                            />
                                            <p style="color: red" id="name"></p>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="folder-open"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="no_of_page"
                                                        v-model="editNo_of_page"
                                                        placeholder="No. Of Page"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="no_of_page"
                                                    ></p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="user"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="author"
                                                        v-model="editAuthor"
                                                        placeholder="Author"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="author"
                                                    ></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="bars"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="category"
                                                        v-model="editCategory"
                                                        placeholder="Category"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="category"
                                                    ></p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="inr"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="price"
                                                        v-model="editPrice"
                                                        placeholder="Price"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="price"
                                                    ></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="calendar"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="released_year"
                                                        v-model="
                                                            editReleased_year
                                                        "
                                                        placeholder="Released Year"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="released_year"
                                                    ></p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <span
                                                        ><font-awesome-icon
                                                            icon="sliders"
                                                    /></span>
                                                    <input
                                                        type="text"
                                                        name="status"
                                                        v-model="editStatus"
                                                        placeholder="Status"
                                                    />
                                                    <p
                                                        style="color: red"
                                                        id="status"
                                                    ></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="address-card"
                                            /></span>
                                            <input
                                                type="text"
                                                name="description"
                                                placeholder="Description"
                                                v-model="editDescription"
                                            />
                                            <p
                                                style="color: red"
                                                id="description"
                                            ></p>
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
            :show="showDeleteModal"
            @close="showDeleteModal = false"
            id="showDeleteModal"
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
                                <h2>Delete Book-Data</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="">
                                    <p
                                        style="color: red"
                                        v-for="error in errors"
                                        :key="error"
                                    >
                                        <!-- {{ error }} -->
                                        <span v-for="err in error" :key="err">
                                            {{ err }}
                                        </span>
                                    </p>
                                    <form @submit.prevent="deleteData()">
                                        <div class="input_field">
                                            <input
                                                type="hidden"
                                                name="bookId"
                                                placeholder="bookId"
                                                v-model="bookId"
                                                readonly
                                            />
                                            <p>
                                                You Want To Delete This
                                                Book-Data..?
                                            </p>
                                            <p
                                                style="color: red"
                                                id="bookId"
                                            ></p>
                                        </div>

                                        <input
                                            class="button"
                                            type="submit"
                                            value="Delete"
                                        />
                                        <button
                                            class="modal-default-button"
                                            @click="closeModal()"
                                            type="button"
                                        >
                                            Cancel
                                        </button>
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
import { ref, reactive, computed, onMounted, onUpdated } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";
import Modal from "./Modal.vue";
import _ from "lodash";
import DataTable from "datatables.net-dt";

import "datatables.net-bs4";

const showModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const route = useRoute();
const router = useRouter();

const username = ref("");
const email = ref("");
const user_id = route.params.user_id;
const baseUrl = "http://127.0.0.1:8000/";

const editName = ref("");
const editDescription = ref("");
const editCategory = ref("");
const editNo_of_page = ref("");
const editPrice = ref("");
const editReleased_year = ref("");
const editStatus = ref("");
const editAuthor = ref("");

const form = ref({
    name: "",
    description: "",
    no_of_page: "",
    author: "",
    category: "",
    price: "",
    released_year: "",
    status: "false",
    userId: "",
});

const bookId = ref(0);
const errors = reactive({});
const searchDataNotFound = reactive({});
const searchRequired = reactive({});
const alerts = reactive({});
const bookData = reactive({});
const search = ref("");
const bookDataLength = ref(0);

const perPage = ref(5);
const pagination = ref({});

const datatable = ref(null);

const setPage = async (p) => {
    try {
        const user_data = await axios.get(baseUrl + "api/user/" + user_id);
        bookData.value = user_data.data.book;
        bookDataLength.value = bookData.value.length;
    } catch (error) {
        console.error(error);
    }

    pagination.value = paginator(bookDataLength.value, p);
};

const collection = computed(() => {
    return paginate(bookData.value);
});

const paginate = (pageData) => {
    return _.slice(
        pageData,
        pagination.value.startIndex,
        pagination.value.endIndex + 1
    );
};

const paginator = (totalItems, currentPage) => {
    const startIndex = (currentPage - 1) * perPage.value;
    const endIndex = Math.min(startIndex + perPage.value - 1, totalItems - 1);

    return {
        currentPage: currentPage,
        startIndex: startIndex,
        endIndex: endIndex,
        pages: _.range(1, Math.ceil(totalItems / perPage.value) + 1),
    };
};

const fetchUser = async () => {
    try {
        const user_data = await axios.get(baseUrl + "api/user/" + user_id);
        username.value = user_data.data.data.name;
        email.value = user_data.data.data.email;
        bookData.value = user_data.data.book;
        bookDataLength.value = bookData.value.length;
        // console.log('Length of bookData:' + bookDataLength.value);
    } catch (error) {}
};

// const filteredData = computed(() => {
//     return bookData.value.filter(data => {
//         return data.name.toLowerCase().includes(search.value.toLowerCase());
//     });
// });

const searchData = async () => {
    try {
        const search_datas = await axios.get(
            "/api/searchData?search=" + search.value
        );

        if (search_datas.data.status === false) {
            // errors.value = search_datas.data.message;
            searchDataNotFound.value = "";
            // searchRequired.value = search_datas.data.message;
        } else {
            // console.log(search_datas.data.book.length == 0);
            if (search_datas.data.book.length == 0) {
                bookData.value = search_datas.data.book;
                searchDataNotFound.value = search_datas.data.message;
                // searchRequired.value = "";
                // console.log(searchDataNotFound);
            } else {
                bookData.value = search_datas.data.book;
                searchDataNotFound.value = "";
                // searchRequired.value = "";
            }
        }
    } catch (error) {}
};

const saveData = async () => {
    try {
        const response = await axios.post(baseUrl + "api/addBook", {
            name: form.value.name,
            description: form.value.description,
            no_of_page: form.value.no_of_page,
            author: form.value.author,
            category: form.value.category,
            price: form.value.price,
            released_year: form.value.released_year,
            status: form.value.status,
            userId: route.params.user_id,
        });
        // console.log(response);
        if (response.data.status === true) {
            errors.value = response.data.message;
            showModal.value = false;
            try {
                const user_data = await axios.get("/api/user/" + user_id);
                // console.log(user_data.data);
                username.value = user_data.data.data.name;
                email.value = user_data.data.data.email;
                bookData.value = user_data.data.book;
                // console.log(bookData);
            } catch (error) {}
        } else {
            console.log(response.data);
            errors.value = response.data.message;
        }
    } catch (error) {
        console.log(error);
    }
};

const modalOpen = async (id) => {
    bookId.value = id;
    try {
        const book_data = await axios.get(baseUrl + "api/getBookData/" + id);
        // console.log(book_data.data.data.name);
        editName.value = book_data.data.data.name;
        editDescription.value = book_data.data.data.description;
        editCategory.value = book_data.data.data.category;
        editNo_of_page.value = book_data.data.data.no_of_page;
        editPrice.value = book_data.data.data.price;
        editReleased_year.value = book_data.data.data.released_year;
        editStatus.value = book_data.data.data.status;
        editAuthor.value = book_data.data.data.author;

        console.log(editName);
        showEditModal.value = true;
    } catch (error) {}
};

const editData = async () => {
    try {
        const edit_response = await axios.post(baseUrl + "api/editBook", {
            name: editName.value,
            description: editDescription.value,
            no_of_page: editNo_of_page.value,
            author: editAuthor.value,
            category: editCategory.value,
            price: editPrice.value,
            released_year: editReleased_year.value,
            status: editStatus.value,
            bookId: bookId.value,
        });

        if (edit_response.data.status === true) {
            // console.log(edit_response.data.status );
            showEditModal.value = false;
            datatable.value = $(".bookDatatable").DataTable().ajax.reload();

            try {
                const user_data = await axios.get("/api/user/" + user_id);
                // console.log(user_data.data);
                username.value = user_data.data.data.name;
                email.value = user_data.data.data.email;
                bookData.value = user_data.data.book;
                // console.log(bookData);
            } catch (error) {}
        } else {
            console.log(response.data);
            // errors.value = response.data.message;
        }
    } catch (error) {
        console.log(error);
    }
};

const modalDelete = async (id) => {
    bookId.value = id;
    showDeleteModal.value = true;
};

const deleteData = async () => {
    try {
        console.log(bookId.value);
        const delete_res = await axios.get(
            baseUrl + "api/deleteData/" + bookId.value
        );
        console.log(delete_res);
        if (delete_res.data.status === true) {
            console.log(delete_res.data.status);
            showDeleteModal.value = false;
            datatable.value = $(".bookDatatable").DataTable().ajax.reload();
            try {
                const user_data = await axios.get("/api/user/" + user_id);
                // console.log(user_data.data);
                username.value = user_data.data.data.name;
                email.value = user_data.data.data.email;
                bookData.value = user_data.data.book;
                // console.log(bookData);
            } catch (error) {}
        } else {
            // errors.value = response.data.message;
        }
    } catch (error) {
        console.log(error);
    }
};

const closeModal = async () => {
    showDeleteModal.value = false;
    showEditModal.value = false;
    showModal.value = false;
    try {
        const user_data = await axios.get("/api/user/" + user_id);
        // console.log(user_data.data);
        username.value = user_data.data.data.name;
        email.value = user_data.data.data.email;
        bookData.value = user_data.data.book;
        // console.log(bookData);
    } catch (error) {}
};

const initDataTable = () => {
    datatable.value = $(".bookDatatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: baseUrl + "api/serverBooks",
        columns: [
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            { data: "description", name: "description" },
            { data: "no_of_page", name: "no_of_page" },
            { data: "author", name: "author" },
            { data: "category", name: "category" },
            { data: "price", name: "price" },
            { data: "released_year", name: "released_year" },
            { data: "status", name: "status" },
            { data: "action", name: "action" },
        ],
        columnDefs: [
            {
                targets: 8,
                render: function (data, type, row) {
                    if (type === "display") {
                        var statusClass =
                            data === "True"
                                ? "status-true-class"
                                : "status-false-class";
                        if (data === "True") {
                            return (
                                '<p class="status-true-class" style=" width: 50%; text-align: center; border: 1px solid #427b35;  border-radius: 5px; background-color: #427b35; color: white;">' +
                                data +
                                "</p>"
                            );
                        } else {
                            return (
                                '<p class="status-false-class" style=" width: 50%; text-align: center; border: 1px solid #9b2925;  border-radius: 5px; background-color: #9b2925; color: white;">' +
                                data +
                                "</p>"
                            );
                        }
                    }
                    return data;
                },
            },
            {
                targets: 9,
                orderable: false,
            },
        ],
    });
};

$(document).on("change", "#bookPages", function () {
    var testId = $(this).val();
    datatable.value.ajax
        .url(baseUrl + "api/serverBooksFilter?value=" + testId)
        .load();
});

$(document).on("change", "#book-Pages", function () {
    var testId = $(this).val();
    $.ajax({
        type: "GET",
        url: baseUrl + "api/booksFilter/?value=" + testId,
        data: {},
        success: function (data) {
            // console.log(data)
            bookData.value = data.book;
            bookDataLength.value = bookData.value.length;
        },
    });
});

document.addEventListener("click", (event) => {
    const target = event.target;

    if (target && target.classList.contains("edit-button")) {
        const bookId = target.getAttribute("data-book-id");
        if (bookId) {
            modalOpen(bookId);
        }
    }

    if (target && target.classList.contains("delete-button")) {
        const bookId = target.getAttribute("data-book-id");
        if (bookId) {
            modalDelete(bookId);
        }
    }
});

onMounted(() => {
    fetchUser();
    setPage(1);
    initDataTable();
});
</script>

<style lang="scss" scoped>
@import "../../css/app.css"; /* injected */

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
</style>
