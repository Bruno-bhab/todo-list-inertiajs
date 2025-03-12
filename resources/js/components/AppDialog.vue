<template>
    <AlertDialog>
    <AlertDialogTrigger as-child>
      <slot></slot>
    </AlertDialogTrigger>
    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>{{ dialogInfo.title }}</AlertDialogTitle>
        <AlertDialogDescription>{{ dialogInfo.message }}</AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogCancel>Cancel</AlertDialogCancel>
        <AlertDialogAction @click="emit('handleClick', dialogInfo.itemId)">Continue</AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>

<script setup lang="ts">
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from '@/components/ui/alert-dialog'

interface IDialogInfo {
    title: string;
    message: string;
    itemId: number;
}

const emit = defineEmits(['handleClick'])
defineProps<{ dialogInfo: IDialogInfo }>()
</script>
