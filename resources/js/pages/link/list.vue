<template>
    <Head title="Links" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Toaster />

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-row items-center justify-between rounded-xl border-2 p-3">
                <h2 class="text-lg font-semibold">Links list</h2>
                <Button>Create new Link</Button>
            </div>

            <div class="flex h-full flex-1 flex-col gap-4 rounded-xl border-2 p-4">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">ID</TableHead>
                            <TableHead>Title</TableHead>
                            <TableHead class="text-right"></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="link in links" :key="link.id">
                            <TableCell class="font-medium">
                                {{ link.id }}
                            </TableCell>
                            <TableCell>
                                {{ link.title }}
                            </TableCell>
                            <TableCell class="text-right flex justify-end">
                                <Button variant="outline" @click="handleEditLink(link.id)">
                                    <Pen class="w-1 h-1" />
                                </Button>
                                <AppDialog @handle-click="handleDeleteLink" :dialog-info="generateDialogToDeleteLink(link.id)">
                                    <Button variant="destructive" class="ml-2">
                                        <Trash class="w-1 h1" />
                                    </Button>
                                </AppDialog>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';

import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Pen, Trash } from 'lucide-vue-next'
import Toaster from '@/components/ui/toast/Toaster.vue';
import AppDialog from '@/components/AppDialog.vue';
import { onMounted, ref } from 'vue';
import { useToast } from '@/components/ui/toast';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Links',
        href: '/link',
    },
];

interface ILink {
    id: number;
    title: string;
    link_name: string;
}

interface PageProps {
    links: ILink[];
    success?: string;
    [key: string]: any;
}

const props = defineProps<{ links: ILink[] }>()


const { toast } = useToast();
const page = usePage<PageProps>();
const linksList = ref<ILink[]>([])



onMounted(() => {
    loadLinksList()
})

const loadLinksList = () => {
    linksList.value = props.links
}

const generateDialogToDeleteLink = (id: number) => {
    return {
        itemId: id,
        title: "Are you absolutely sure?",
        message: "This action cannot be undone. This will permanently delete your link."
    }
}

const handleEditLink = (id: number) => {
    router.get(route('link.edit', id));
}

const handleDeleteLink = (id: number) => {
    const toastDuration = 1000

    router.delete(
        route('link.destroy', id),
        {
            onSuccess: () => {
                linksList.value = page.props.links;
                toast({
                    description: 'Link deleted',
                    duration: toastDuration,
                    class: 'bg-orange-300 text-black'
                });
            },
            onError: (errors) => {
                console.error(errors);
                toast({
                    description: 'Erro ao realizar opção! Entre em contato com o suporte.',
                    variant: 'destructive',
                    duration: toastDuration
                });
            },
        },
    );
}
</script>
