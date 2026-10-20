```vue
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    books: Object,
});
</script>

<template>
    <Head title="Data Buku" />

    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 px-6 py-8 sm:px-8">

            <!-- Judul halaman -->
            <div class="mb-6 flex flex-col gap-4 sm:flex-row
                        sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Data Buku
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Daftar buku yang tersedia di perpustakaan.
                    </p>
                </div>

                <!-- Tombol tambah buku -->
                <Link
                    href="/books/create"
                    class="inline-flex items-center justify-center
                           rounded-lg bg-blue-600 px-5 py-3
                           text-sm font-semibold text-white
                           shadow-sm transition hover:bg-blue-700"
                >
                    + Tambah Buku
                </Link>
            </div>

            <!-- Tabel data buku -->
            <div class="overflow-hidden rounded-xl bg-white shadow-md">

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">

                        <thead class="bg-gray-800 text-xs uppercase
                                      tracking-wider text-white">
                            <tr>
                                <th class="px-6 py-4">
                                    No.
                                </th>

                                <th class="px-6 py-4">
                                    Kode Buku
                                </th>

                                <th class="px-6 py-4">
                                    Judul
                                </th>

                                <th class="px-6 py-4">
                                    Pengarang
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Stok
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            <tr
                                v-for="(book, index) in (books?.data ?? books ?? [])"
                                :key="book.id"
                                class="transition hover:bg-blue-50"
                            >
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ index + 1 }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4
                                           font-medium text-gray-900">
                                    {{ book.kode_buku }}
                                </td>

                                <td class="min-w-48 px-6 py-4
                                           font-medium text-gray-800">
                                    {{ book.judul }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ book.pengarang }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex min-w-10
                                               justify-center rounded-full
                                               bg-green-100 px-3 py-1
                                               font-semibold text-green-700"
                                    >
                                        {{ book.stok }}
                                    </span>
                                </td>
                            </tr>

                            <!-- Jika belum ada data -->
                            <tr v-if="!(books?.data ?? books ?? []).length">
                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center"
                                >
                                    <p class="font-medium text-gray-700">
                                        Belum ada data buku
                                    </p>

                                    <p class="mt-1 text-gray-500">
                                        Silakan tambahkan buku terlebih dahulu.
                                    </p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Informasi jumlah buku -->
                <div
                    class="border-t border-gray-200 bg-gray-50
                           px-6 py-4 text-sm text-gray-500"
                >
                    Total buku:
                    <span class="font-semibold text-gray-800">
                        {{ (books?.data ?? books ?? []).length }}
                    </span>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
```