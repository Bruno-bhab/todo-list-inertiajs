<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Toaster />

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-row items-center justify-between rounded-xl border-2 p-3">
                <h2 class="text-lg font-semibold">Todo list</h2>
                <Dialog v-model:open="isDialogOpen">
                    <DialogTrigger as-child>
                        <Button variant="outline" @click="isDialogOpen = true">New Todo</Button>
                    </DialogTrigger>
                    <DialogContent class="sm:max-w-[425px]">
                        <DialogHeader>
                            <DialogTitle>New Todo</DialogTitle>
                            <DialogDescription>Set a tile for your todo and a description</DialogDescription>
                        </DialogHeader>
                        <form @submit.prevent="handleSaveTodo">
                            <div class="grid gap-4 py-4">
                                <div class="grid grid-cols-4 items-center gap-4">
                                    <Label for="title" class="text-right">Title</Label>
                                    <Input id="title" v-model="formTodo.title" class="col-span-3" />
                                </div>
                                <div class="grid grid-cols-4 items-center gap-4">
                                    <Label for="description" class="text-right">Description</Label>
                                    <Input id="description" v-model="formTodo.description" class="col-span-3" />
                                </div>
                            </div>
                            <DialogFooter>
                                <Button type="submit">Save todo</Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>

            <div class="flex h-full flex-1 flex-col gap-4 rounded-xl border-2 p-4">
                <Table>
                    <TableCaption>A list of your todos.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">ID</TableHead>
                            <TableHead>Title</TableHead>
                            <TableHead class="text-right">Completed</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="item in tableValues" :key="item.id" :class="{ 'text-gray-500 line-through': item.completed }">
                            <TableCell class="font-medium">
                                {{ item.id }}
                            </TableCell>
                            <TableCell>
                                {{ item.title }}
                            </TableCell>
                            <TableCell class="text-right flex justify-end">
                                <Button variant="outline" v-if="!item.completed" @click="() => handleCompleteTodo(item.id, !item.completed)">
                                    <Check class="w-1 h-1" />
                                </Button>
                                <Button variant="default" class="bg-green-400" v-else @click="() => handleCompleteTodo(item.id, !item.completed)">
                                    <Check class="w-1 h-1" />
                                </Button>
                                <Button variant="destructive" class="ml-2" @click="() => handleDeleteTodo(item.id)">
                                    <Trash class="w-1 h1" />
                                </Button>
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
import { defineProps, onMounted, reactive, ref, watch } from 'vue';

import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Toaster from '@/components/ui/toast/Toaster.vue';
import { useToast } from '@/components/ui/toast/use-toast';
import { Check, Trash } from 'lucide-vue-next'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Todos',
        href: '/todo',
    },
];

interface ITableValues {
    id: number;
    title: string;
    completed: boolean;
}

interface PageProps {
    todos: ITableValues[];
    success?: string;
    [key: string]: any;
}

const { toast } = useToast();
const page = usePage<PageProps>();

const tableValues = ref<ITableValues[]>([]);
const props = defineProps<{ todos: ITableValues[] }>();
const successMessage = ref('');
const errorMessage = ref('');
const isDialogOpen = ref(false);
const formTodo = reactive({
  title: "",
  description: "",
})

onMounted(() => {
    generateTodoList();
});

watch(successMessage, (newMsg, oldMsg) => {
    if (newMsg !== '') {
        setInterval(() => {
            successMessage.value = oldMsg;
        }, 500000);
    }
});

watch(errorMessage, (newMsg, oldMsg) => {
    if (newMsg !== '') {
        setInterval(() => {
            errorMessage.value = oldMsg;
        }, 500000);
    }
});

const generateTodoList = () => {
    if (props.todos && props.todos.length > 0) {
        tableValues.value = [];
        props.todos.forEach((element) => {
            tableValues.value.push(element);
        });
    }
};

const handleCompleteTodo = (id: number, completed: boolean) => {
    router.put(
        route('todo.update', id),{completed},
        {
            onSuccess: () => {
                tableValues.value = page.props.todos;
                toast({
                    description: 'Todo completed',
                });
            },
            onError: (errors) => {
                console.error(errors);
                toast({
                    description: 'Erro ao realizar opção! Entre em contato com o suporte.',
                    variant: 'destructive',
                });
            },
        },
    );
};

const handleSaveTodo = () => {
    router.post(route('todo.store'), formTodo, {
        onSuccess: () => {
                tableValues.value = page.props.todos;
                isDialogOpen.value = false;
                toast({
                    description: 'Todo created',
                    class: 'bg-green-500 text-white',
                });
            },
        onError: (errors) => {
            console.error(errors);
            toast({
                description: 'Erro ao realizar opção! Entre em contato com o suporte.',
                variant: 'destructive',
            });
        },
    })
}

const handleDeleteTodo = (id: number) => {
    router.delete(
        route('todo.destroy', id),
        {
            onSuccess: () => {
                tableValues.value = page.props.todos;
                toast({
                    description: 'Todo deleted',
                });
            },
            onError: (errors) => {
                console.error(errors);
                toast({
                    description: 'Erro ao realizar opção! Entre em contato com o suporte.',
                    variant: 'destructive',
                });
            },
        },
    );
}
</script>
