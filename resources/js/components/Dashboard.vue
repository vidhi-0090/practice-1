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
                id="show-modal"
                @click="showPasswordModel = true"
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
                                v-if="data.status == 1"
                                class="status-true-class"
                            >
                                True
                            </p>
                            <p
                                v-if="data.status == 0"
                                class="status-false-class"
                            >
                                False
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
                                        v-for="error in success"
                                        :key="error"
                                    >
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
                                            <p style="color: red" id="name">
                                                {{ errors.name }}
                                            </p>
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
                                                    >
                                                        {{ errors.no_of_page }}
                                                    </p>
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
                                                    >
                                                        {{ errors.author }}
                                                    </p>
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
                                                    >
                                                        {{ errors.category }}
                                                    </p>
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
                                                    >
                                                        {{ errors.price }}
                                                    </p>
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
                                                    >
                                                        {{
                                                            errors.released_year
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <lable
                                                        style="color: #6e7582"
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
                                                    >
                                                        {{ errors.status }}
                                                    </p>
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
                                            >
                                                {{ errors.description }}
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
                                <h2>Edit Book-Data</h2>
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
                                    <form @submit.prevent="editData()">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon
                                                    icon="certificate"
                                            /></span>
                                            <input
                                                type="hidden"
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
                                            <p style="color: red" id="name">
                                                {{ errors.name }}
                                            </p>
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
                                                    >
                                                        {{ errors.no_of_page }}
                                                    </p>
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
                                                    >
                                                        {{ errors.author }}
                                                    </p>
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
                                                    >
                                                        {{ errors.category }}
                                                    </p>
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
                                                    >
                                                        {{ errors.price }}
                                                    </p>
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
                                                    >
                                                        {{
                                                            errors.released_year
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field">
                                                    <label
                                                        class="relative inline-flex items-center mr-5 cursor-pointer"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            value="true"
                                                            class="sr-only peer"
                                                            name="status"
                                                            v-model="editStatus"
                                                            checked
                                                        />
                                                        <div
                                                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-800"
                                                        ></div>
                                                        <span
                                                            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                            >Status</span
                                                        >
                                                    </label>
                                                    <p
                                                        style="color: red"
                                                        id="status"
                                                    >
                                                        {{ errors.status }}
                                                    </p>
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
                                            >
                                                {{ errors.description }}
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
                                        v-for="error in success"
                                        :key="error"
                                    >
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

        <modal
            :show="showPasswordModel"
            @close="showPasswordModel = false"
            id="showPasswordModel"
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
                                <h2>Change Password</h2>
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
                                    <form @submit.prevent="changePassword()">
                                        <div class="input_field">
                                            <input
                                                type="password"
                                                name="current_password"
                                                placeholder="Current Password"
                                                v-model="current_password"
                                            />
                                            <p style="color: red">
                                                {{ errors.current_password }}
                                            </p>
                                        </div>

                                        <div class="input_field">
                                            <input
                                                type="password"
                                                name="password"
                                                placeholder="Password"
                                                v-model="password"
                                            />
                                            <p style="color: red">
                                                {{ errors.password }}
                                            </p>
                                        </div>

                                        <div class="input_field">
                                            <input
                                                type="password"
                                                name="password_confirmation"
                                                placeholder="Password Confirmation"
                                                v-model="password_confirmation"
                                            />
                                            <p style="color: red">
                                                {{
                                                    errors.password_confirmation
                                                }}
                                            </p>
                                        </div>
                                        <input
                                            class="button"
                                            type="submit"
                                            value="Change Password"
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
import { ref, reactive, computed, onMounted, onUpdated } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";
import Modal from "./Modal.vue";
import _ from "lodash";
import DataTable from "datatables.net-dt";
import Swal from "sweetalert2";
import "datatables.net-bs4";

const showModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const showPasswordModel = ref(false);
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
const editStatus = ref("false");
const editAuthor = ref("");

const password = ref("");
const current_password = ref("");
const password_confirmation = ref("");

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

const errors = reactive({
    name: "",
    no_of_page: "",
    author: "",
    category: "",
    price: "",
    released_year: "",
    status: "",
    description: "",
    password: "",
    current_password: "",
    password_confirmation:""
});
const success = reactive({});
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
        const user_data = await axios.get(baseUrl + "api/users");
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
        const user_data = await axios.get(baseUrl + "api/users");
        username.value = user_data.data.data.name;
        email.value = user_data.data.data.email;
        bookData.value = user_data.data.book;
        bookDataLength.value = bookData.value.length;
    } catch (error) {
        console.log(error);
    }
};

const searchData = async () => {
    try {
        const search_datas = await axios.get(
            "/api/searchData?search=" + search.value
        );

        if (search_datas.data.status === false) {
            searchDataNotFound.value = "";
        } else {
            if (search_datas.data.book.length == 0) {
                bookData.value = search_datas.data.book;
                searchDataNotFound.value = search_datas.data.message;
            } else {
                bookData.value = search_datas.data.book;
                searchDataNotFound.value = "";
            }
        }
    } catch (error) {}
};

const saveData = async () => {
    try {
        const response = await axios.post(baseUrl + "api/books", {
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
        if (response.data.status === true) {
            success.value = response.data.message;
            showModal.value = false;
            Swal.fire({
                icon: "success",
                title: "Add Book-Data Successful",
                showConfirmButton: true,
            });
            datatable.value = $(".bookDatatable").DataTable().ajax.reload();
            try {
                const user_data = await axios.get("/api/users");
                username.value = user_data.data.data.name;
                email.value = user_data.data.data.email;
                bookData.value = user_data.data.book;
            } catch (error) {}
        } else {
            console.log(response.data);
            // errors.value = response.data.message;
            const responseErrors = response.data.message;
            for (const field in responseErrors) {
                if (field in errors) {
                    errors[field] = responseErrors[field][0];
                }
            }
        }
    } catch (error) {
        console.log(error);
    }
};

const modalOpen = async (id) => {
    bookId.value = id;
    try {
        const book_data = await axios.get(baseUrl + "api/books/" + id);
        editName.value = book_data.data.data.name;
        editDescription.value = book_data.data.data.description;
        editCategory.value = book_data.data.data.category;
        editNo_of_page.value = book_data.data.data.no_of_page;
        editPrice.value = book_data.data.data.price;
        editReleased_year.value = book_data.data.data.released_year;
        editStatus.value = book_data.data.data.status;
        editAuthor.value = book_data.data.data.author;

        showEditModal.value = true;
    } catch (error) {}
};

const editData = async () => {
    try {
        const edit_response = await axios.put(baseUrl + "api/books/" + bookId.value, {
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
            success.value = edit_response.data.message;
            showEditModal.value = false;
            Swal.fire({
                icon: "success",
                title: "Successful Edit Book-Data",
                showConfirmButton: true,
            });
            datatable.value = $(".bookDatatable").DataTable().ajax.reload();
            try {
                const user_data = await axios.get("/api/users");
                username.value = user_data.data.data.name;
                email.value = user_data.data.data.email;
                bookData.value = user_data.data.book;
            } catch (error) {}
        } else {
            // console.log(response.data);
            const responseErrors = edit_response.data.message;
            for (const field in responseErrors) {
                if (field in errors) {
                    errors[field] = responseErrors[field][0];
                }
            }
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
        const delete_res = await axios.delete(
            baseUrl + "api/books/" + bookId.value
        );
        console.log(delete_res);
        if (delete_res.data.status === true) {
            console.log(delete_res.data.status);
            showDeleteModal.value = false;
            Swal.fire({
                icon: "success",
                title: "Successful Delete Book-Data",
                showConfirmButton: true,
            });
            datatable.value = $(".bookDatatable").DataTable().ajax.reload();
            try {
                const user_data = await axios.get("/api/users");
                username.value = user_data.data.data.name;
                email.value = user_data.data.data.email;
                bookData.value = user_data.data.book;
            } catch (error) {}
        } else {
            // errors.value = response.data.message;
        }
    } catch (error) {
        console.log(error);
    }
};

const changePassword = async () => {
    try {
        const response = await axios.post(baseUrl + "api/changePassword", {
            current_password: current_password.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });
        if (response.data.status === true) {
            success.value = response.data.message;
            showPasswordModel.value = false;
            Swal.fire({
                icon: "success",
                title: "Successful Change Password",
                showConfirmButton: true,
            }).then(() => {

            });
        } else {
            const responseErrors = response.data.message;
            for (const field in responseErrors) {
                if (field in errors) {
                    errors[field] = responseErrors[field][0];
                }
            }
        }
    } catch (error) {
        console.log(error);
    }
};

const closeModal = async () => {
    showDeleteModal.value = false;
    showEditModal.value = false;
    showModal.value = false;
    showPasswordModel.value = false;
    try {
        const user_data = await axios.get("/api/users");
        username.value = user_data.data.data.name;
        email.value = user_data.data.data.email;
        bookData.value = user_data.data.book;
    } catch (error) {}
};

const initDataTable = () => {
    datatable.value = $(".bookDatatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: baseUrl + "api/books",
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
                        if (data == "True") {
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
            console.log(data.book);
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
</style>
