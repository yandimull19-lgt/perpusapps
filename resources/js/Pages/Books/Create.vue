
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: '',
    stok: 0,
});

function submit() {
    form.post(route('books.store'));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 p-6">
            <div class="mx-auto max-w-3xl">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Tambah Buku
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Silakan isi data buku yang ingin ditambahkan.
                    </p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <form @submit.prevent="submit" class="space-y-5">
                        <div>
                            <label class="mb-2 block font-medium text-gray-700">
                                Kode Buku
                            </label>
                            <input
                                v-model="form.kode_buku"
                                type="text"
                                placeholder="Contoh: BK005"
                                required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                            />
                            <p v-if="form.errors.kode_buku" class="mt-1 text-sm text-red-600">
                                {{ form.errors.kode_buku }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-2 block font-medium text-gray-700">
                                Judul Buku
                            </label>
                            <input
                                v-model="form.judul"
                                type="text"
                                placeholder="Masukkan judul buku"
                                required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                            />
                            <p v-if="form.errors.judul" class="mt-1 text-sm text-red-600">
                                {{ form.errors.judul }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-2 block font-medium text-gray-700">
                                Pengarang
                            </label>
                            <input
                                v-model="form.pengarang"
                                type="text"
                                placeholder="Masukkan nama pengarang"
                                required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                            />
                            <p v-if="form.errors.pengarang" class="mt-1 text-sm text-red-600">
                                {{ form.errors.pengarang }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-2 block font-medium text-gray-700">
                                Penerbit
                            </label>
                            <input
                                v-model="form.penerbit"
                                type="text"
                                placeholder="Masukkan nama penerbit"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                            />
                            <p v-if="form.errors.penerbit" class="mt-1 text-sm text-red-600">
                                {{ form.errors.penerbit }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-2 block font-medium text-gray-700">
                                Tahun Terbit
                            </label>
                            <input
                                v-model="form.tahun"
                                type="number"
                                min="1000"
                                max="9999"
                                placeholder="Contoh: 2026"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                            />
                            <p v-if="form.errors.tahun" class="mt-1 text-sm text-red-600">
                                {{ form.errors.tahun }}
                            </p>
                        </div>

                        <div>
                            <label class="mb-2 block font-medium text-gray-700">
                                Stok
                            </label>
                            <input
                                v-model.number="form.stok"
                                type="number"
                                min="0"
                                required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                            />
                            <p v-if="form.errors.stok" class="mt-1 text-sm text-red-600">
                                {{ form.errors.stok }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3 border-t pt-5">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="rounded-md bg-blue-600 px-5 py-2 font-medium text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                {{ form.processing ? 'Menyimpan...' : 'Simpan Buku' }}
                            </button>

                            <Link
                                href="/books"
                                class="rounded-md bg-gray-200 px-5 py-2 font-medium text-gray-700 hover:bg-gray-300"
                            >
                                Kembali
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
