
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    books: Object,
    search: String,
});

// Menampilkan kata kunci pencarian sebelumnya
const keyword = ref(props.search ?? '');

// Fungsi pencarian buku
function cari() {
    router.get('/books', {
        search: keyword.value
    });
}

// Fungsi menghapus buku
function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="mb-4 text-2xl font-bold">Data Buku</h1>

            <!-- Pesan berhasil -->
            <div
                v-if="$page.props.flash?.success"
                class="mb-4 rounded bg-green-100 p-3 text-green-700"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Tombol tambah buku -->
            <div class="mb-4">
                <Link
                    href="/books/create"
                    class="rounded bg-blue-600 px-4 py-2 text-white"
                >
                    + Tambah Buku
                </Link>
            </div>

            <!-- Kotak pencarian -->
            <div class="mb-4">
                <input
                    v-model="keyword"
                    @keyup.enter="cari"
                    type="text"
                    placeholder="Cari judul atau pengarang..."
                    class="w-full rounded border px-3 py-2"
                />

                <button
                    @click="cari"
                    type="button"
                    class="mt-2 rounded bg-gray-700 px-4 py-2 text-white"
                >
                    Cari
                </button>
            </div>

            <!-- Tabel data buku -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Kode</th>
                            <th class="border p-2">Judul</th>
                            <th class="border p-2">Pengarang</th>
                            <th class="border p-2">Stok</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="book in props.books.data"
                            :key="book.id"
                        >
                            <td class="border p-2">
                                {{ book.kode_buku }}
                            </td>

                            <td class="border p-2">
                                {{ book.judul }}
                            </td>

                            <td class="border p-2">
                                {{ book.pengarang }}
                            </td>

                            <td class="border p-2">
                                {{ book.stok }}
                            </td>

                            <td class="border p-2">
                                <div class="flex gap-2">
                                    <Link
                                        :href="`/books/${book.id}/edit`"
                                        class="rounded bg-yellow-500 px-3 py-1 text-white"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        @click="hapus(book.id)"
                                        type="button"
                                        class="rounded bg-red-600 px-3 py-1 text-white"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr v-if="props.books.data.length === 0">
                            <td
                                colspan="5"
                                class="border p-4 text-center"
                            >
                                Data buku tidak ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Navigasi halaman -->
            <div class="mt-4 flex flex-wrap gap-2">
                <template
                    v-for="(link, index) in props.books.links"
                    :key="index"
                >
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        v-html="link.label"
                        class="rounded border px-3 py-2"
                        :class="{
                            'bg-blue-600 text-white': link.active
                        }"
                    />

                    <span
                        v-else
                        v-html="link.label"
                        class="rounded border px-3 py-2 text-gray-400"
                    />
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
