<template>
    <div class="flex flex-col items-center justify-start w-full p-4">
        <h2 class="text-2xl">Create/Edit link</h2>
        <div class="w-full">
            <div class="grid w-full items-center gap-1.5 mt-12">
                <div class="flex items-center justify-center">
                    <img :src="link.logo" class="w-40 h-40 rounded-full shadow-xl">
                    <div
                        class="flex items-center justify-center absolute w-40 h-40 opacity-0 hover:bg-black hover:opacity-70 hover:cursor-pointer rounded-full"
                        @click="handleSetLogo"
                    >
                        <Pen color="#fff"/>
                    </div>
                </div>
                <Input @change="handleFileUpload" style="display: none;" id="logo" type="file" accept="image/png, image/jpeg"/>
            </div>
            <div class="grid grid-cols-2 w-full items-center gap-1.5 mt-12">
                <div>
                    <Label for="title">Title:</Label>
                    <Input v-model="linkInfo.title" id="title" type="title" placeholder="title" />
                </div>

                <div>
                    <Label for="link_name">Link name:</Label>
                    <Input v-model="linkInfo.link_name" id="link_name" type="link_name" placeholder="link_name" />
                </div>
            </div>
            <div class="grid w-full items-center gap-1.5 mt-4">
                <Label for="description">Description:</Label>
                <Textarea v-model="linkInfo.description" id="description" type="description" placeholder="description" />
            </div>
            <div class="flex flex-col items-center justify-center w-full items-center gap-1.5 mt-4">
                <draggable
                    v-model="myArray"
                    group="people"
                    @start="drag=true"
                    @end="drag=false"
                    item-key="id"
                    class="flex flex-col items-center justify-center w-full"
                >
                    <template #item="{element}">
                        <Button class="w-2/3 h-20 my-2 text-xl hover:cursor-move">{{ element.name }}</Button>
                    </template>
                </draggable>
                <Button variant="outline" class="w-full w-2/3 h-20 my-2">New</Button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ILink } from '@/types/links';
import { reactive, ref, toRefs } from 'vue';
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Pen } from 'lucide-vue-next'
import Button from '../ui/button/Button.vue';
import draggable from 'vuedraggable'

const props = defineProps<{ link: ILink }>()
const linkInfo = reactive(toRefs(props.link));
const drag = ref(false)
const myArray = ref([
    {
        id: 1,
        name: "Meu site"
    },
    {
        id: 2,
        name: "Youtube"
    },
    {
        id: 3,
        name: "Facebook"
    }
])

const handleSetLogo = () => {
    document.getElementById('logo')?.click()
}

const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = () => {
            linkInfo.logo = reader.result as string;

        };

        reader.readAsDataURL(file);
    }
};
</script>
