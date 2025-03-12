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
            <div class="grid w-full items-center gap-1.5 mt-12">
                <Label for="title">Title:</Label>
                <Input v-model="linkInfo.title" id="title" type="title" placeholder="title" />
            </div>
            <div class="grid w-full items-center gap-1.5 mt-12">
                <Label for="description">Description:</Label>
                <Textarea v-model="linkInfo.description" id="description" type="description" placeholder="description" />
            </div>
        </div>

    </div>
</template>

<script setup lang="ts">
import { ILink } from '@/types/links';
import { reactive } from 'vue';
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Pen } from 'lucide-vue-next'

const props = defineProps<{ link: ILink }>()
const linkInfo = reactive(props.link)

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
