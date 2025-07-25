<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Product, type BreadcrumbItem } from '@/types';
import VariantLayout from '@/layouts/products-management/VariantLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Icon } from '@iconify/vue';
import {
    SelectContent, SelectGroup, SelectItem, SelectItemIndicator, SelectItemText, SelectPortal, SelectRoot, SelectTrigger, SelectValue, SelectViewport,
} from 'radix-vue';
import { capitalize, ref, watch } from 'vue';
import { CircleAlert, PlusCircle, X } from 'lucide-vue-next';
import { Card } from '@/components/ui/card';

interface Props {
    product: Product;
    sizeAvailability: string[];
    colorAvailability: string[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: route('products.index'),
    },
    {
        title: props.product.name,
        href: route('products.variants.index', {product: props.product}),
    },
    {
        title: 'New variant',
        href: route('products.variants.create', {product: props.product}),
    },
];

const getColorCode = (color: string): string => {
    return 'bg-' + color + '-500';
};

const sizeValue = ref<string | null>(null);
const colorValue = ref<string | null>(null);

const getInitials = (product: Product) => {
    let categoryName = product.category.name.split(' ').map((word) => {
        return capitalize(word[0]);
    });

    let productName = product.name.split(' ').map((word) => {
        return capitalize(word[0]);
    });

    let size = '';

    if (sizeValue.value && sizeValue.value !== 'Not Available') {
        size = '-' + sizeValue.value;
    }

    let color = '';

    if (colorValue.value && colorValue.value !== 'Not Available') {
        color = '-' + capitalize(colorValue.value);
    }

    return categoryName.join('') + '-' + productName.join('') + size + color;
};

const variantForm = useForm({
    sku: getInitials(props.product),
    size: undefined,
    color: undefined,
    stock: undefined,
    images: [{}],
});

watch(variantForm, (newValue) => {
    sizeValue.value = newValue.size ?? null;
    colorValue.value = newValue.color ?? null;
}, {immediate: true});

watch([sizeValue, colorValue], () => {
    variantForm.sku = getInitials(props.product);
}, {immediate: true});

const submitVariantForm = () => {
    variantForm.post(route('products.variants.store', {product: props.product}), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            if (variantForm.recentlySuccessful) {
                setTimeout(() => {
                    variantForm.reset();
                    router.get(route('products.variants.index', {product: props.product}));
                }, 1000);
            }
        },
        onError: () => {
            for (const errorKey in variantForm.errors) {
                if (errorKey.startsWith('images.')) {
                    const parts = errorKey.split('.'); 
                    const errorIndex = parseInt(parts[1]);

                    images.value[errorIndex].invalid = true;
                }
            }
        }
    });
};

const images = ref<{
    name: string;
    file: object;
    url: string;
    invalid: boolean;
}[]>([]);

const selectedIndex = ref<number>(0);

const selectImage = (index: number) => {
    selectedIndex.value = index;
};

const onFileChange = (event: Event) => {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const url = URL.createObjectURL(file);

        if (images.value.length <= 4) {
            images.value.push({name: file.name, file, url, invalid:false });
        }
    }

    variantForm.images = Array.from(images.value.map((image) => {
        return image.file;
    }));
}

const removeImage = (index: number) => {
    if (selectedIndex.value === index) {
        selectedIndex.value = 0;
    }

    else if (selectedIndex.value > index) {
        selectedIndex.value -= 1;
    }

    images.value.splice(index, 1);
    variantForm.images = images.value.map(image => image.file);
};
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="product.name" />

        <template hidden>
            <span class="sr-only" hidden>Load all colors availability in compile-time</span>
            <div hidden :class="[
                'bg-red-500', 'bg-orange-500', 'bg-amber-500', 'bg-yellow-500', 'bg-lime-500', 'bg-green-500',
                'bg-emerald-500', 'bg-teal-500', 'bg-cyan-500', 'bg-sky-500', 'bg-blue-500', 'bg-indigo-500',
                'bg-violet-500', 'bg-purple-500', 'bg-fuchsia-500', 'bg-pink-500', 'bg-rose-500',
            ]"></div>
        </template>

        <VariantLayout :product="product" class="w-full">
            <div class="flex gap-10">
                <div class="flex flex-col space-y-6 w-full">
                    <HeadingSmall title="Create new variant" description="Fill out the form below to add a new variant to your catalog. Make sure to provide accurate details to help customers find and purchase your product" class="w-1/2 pr-10" />

                    <div class="flex w-full space-x-10">
                        <form @submit.prevent="submitVariantForm" class="space-y-6 w-1/2">
                            <div class="grid gap-2">
                                <Label for="sku">SKU</Label>
                                <HeadingSmall title="" description="SKU will be auto-generated based-on size and color values, followed by 13-digit unique ID" />
                                <Input id="sku" class="mt-1 block w-full bg-muted hover:pointer-events-none cursor-none" disabled aria-disabled="The value is auto-generated" v-model="variantForm.sku" required />
                                <InputError class="mt-2" :message="variantForm.errors.color" />
                            </div>
        
                            <div class="grid gap-2">
                                <Label for="size">Size</Label>
                                <div class="flex mt-1 w-full h-full gap-2.5 justify-between items-center">
                                    <SelectRoot id="size" v-model="variantForm.size" required>
                                        <SelectTrigger
                                            :class="[
                                                'block w-full h-full file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                                'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                                'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                                'flex items-center justify-between cursor-pointer'
                                            ]"
                                            aria-label="Size options"
                                        >
                                            <SelectValue :class="{'text-muted-foreground': !variantForm.size}" placeholder="Select size" />
                                            <Icon icon="radix-icons:chevron-down" class="h-full w-3.5 ml-2"/>
                                        </SelectTrigger>
            
                                        <SelectPortal>
                                            <SelectContent
                                                class="min-w-[160px] bg-white rounded shadow-[0px_10px_38px_-10px_rgba(22,_23,_24,_0.35),_0px_10px_20px_-15px_rgba(22,_23,_24,_0.2)] will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
                                                :side-offset="5"
                                            >
                                                <SelectViewport class="p-2">
                                                    <SelectGroup>
                                                        <SelectItem
                                                            v-for="size in sizeAvailability"
                                                            :key="size"
                                                            class="text-sm leading-none rounded flex items-center h-7 relative select-none data-[disabled]:text-muted data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-primary data-[highlighted]:text-primary-foreground"
                                                            :value="size"
                                                        >
                                                            <div class="relative flex flex-row items-center">
                                                                <SelectItemIndicator class="absolute pl-2 h-full inline-flex items-center justify-center">
                                                                    <Icon icon="radix-icons:check" />
                                                                </SelectItemIndicator>
                
                                                                <SelectItemText class="pl-8">{{ size }}</SelectItemText>
                                                            </div>
                                                        </SelectItem>
                                                    </SelectGroup>
                                                </SelectViewport>
                                            </SelectContent>
                                        </SelectPortal>
                                    </SelectRoot>
                                </div>
                            </div>
        
                            <div class="grid gap-2">
                                <Label for="color">Color</Label>
                                <div class="flex mt-1 w-full h-full gap-2.5 justify-between items-center">
                                    <SelectRoot id="color" v-model="variantForm.color" required>
                                        <SelectTrigger
                                            :class="[
                                                'block w-full h-full file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                                'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                                'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                                'flex items-center justify-between cursor-pointer'
                                            ]"
                                            aria-label="Color options"
                                        >
                                            <SelectValue :class="{'text-muted-foreground': !variantForm.color}" placeholder="Select color" />
                                            <Icon icon="radix-icons:chevron-down" class="h-full w-3.5 ml-2"/>
                                        </SelectTrigger>
            
                                        <SelectPortal>
                                            <SelectContent
                                                class="min-w-[160px] bg-white rounded shadow-[0px_10px_38px_-10px_rgba(22,_23,_24,_0.35),_0px_10px_20px_-15px_rgba(22,_23,_24,_0.2)] will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
                                                :side-offset="5"
                                            >
                                                <SelectViewport class="p-2">
                                                    <SelectGroup>
                                                        <SelectItem
                                                            v-for="color in colorAvailability"
                                                            :key="color"
                                                            class="text-sm leading-none rounded flex items-center h-7 relative select-none data-[disabled]:text-muted data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-primary data-[highlighted]:text-primary-foreground"
                                                            :value="color"
                                                        >
                                                            <div class="relative flex flex-row items-center">
                                                                <SelectItemIndicator class="absolute pl-2 h-full inline-flex items-center justify-center">
                                                                    <Icon icon="radix-icons:check" />
                                                                </SelectItemIndicator>
        
                                                                <div class="rounded-full size-3.5 ml-8" :class="getColorCode(color)" />
                
                                                                <SelectItemText class="pl-2">{{ capitalize(color) }}</SelectItemText>
                                                            </div>
                                                        </SelectItem>
                                                    </SelectGroup>
                                                </SelectViewport>
                                            </SelectContent>
                                        </SelectPortal>
                                    </SelectRoot>
                                </div>
                            </div>
        
                            <div class="grid gap-2">
                                <Label for="stock">Stock</Label>
                                <Input id="stock" class="mt-1 block w-full" v-model="variantForm.stock" required placeholder="How many available stock?" />
                                <InputError class="mt-2" :message="variantForm.errors.stock" />
                            </div>
        
                            <div class="flex items-center gap-4">
                                <Button class="cursor-pointer" :disabled="variantForm.processing">Create</Button>
        
                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-show="variantForm.recentlySuccessful" class="text-sm text-neutral-600">Created.</p>
                                </Transition>
                            </div>
                        </form>

                        <div class="flex flex-col w-1/2 gap-2 mr-10">
                            <Label for="images">Images</Label>
                            <HeadingSmall title="" description="No more than 5 images can be linked to each variant. Only accepts JPG, JPEG, and PNG types." />
                            <div class="rounded-box w-full h-full flex justify-center mt-1">
                                <div class="w-full flex justify-center items-center">
                                    <div v-if="images.length === 0" class="relative w-full bg-muted rounded-2xl flex justify-center items-center h-96">
                                        <span class="text-2xl text-primary/50 font-semibold">No Image</span>
                                    </div>

                                    <img v-else
                                        :src="images[selectedIndex].url"
                                        class="rounded-2xl h-96 object-fill"
                                    />
                                </div>
                            </div>

                            <div class="flex justify-center gap-4 overflow-x-auto scrollbar-hide w-full h-20 pt-2">
                                <Card
                                    v-for="(image, index) in images"
                                    :key="index"
                                    @click="selectImage(index)"
                                    class="relative cursor-pointer size-20 rounded-md flex items-center justify-center h-full overflow-visible p-0.5"
                                    :class="{
                                        'border-primary': selectedIndex === index,
                                        'border-transparent': selectedIndex !== index,
                                        'border-red-500 border-2': image.invalid,
                                    }"
                                >   
                                    <div 
                                        v-if="image.invalid"
                                        :key="'alert' + index"
                                        class="flex justify-center items-center h-full bg-transparent w-full"
                                    >
                                        <CircleAlert class="size-7 text-red-500" />
                                    </div>

                                    <img
                                        v-else
                                        :key="'image' + index"
                                        :src="image.url"
                                        :alt="'Thumbnail ' + index"
                                        class="object-fill rounded hover:opacity-60 transition duration-300 h-full w-fit"
                                    />

                                    <X @click.stop="removeImage(index)"
                                        :key="index"
                                        class="absolute -top-2 -right-2 size-4 text-primary hover:cursor-pointer hover:scale-110 hover:border hover:border-primary bg-muted rounded-full" 
                                    />
                                </Card>

                                <div v-if="images.length <= 4" class="relative bg-muted rounded-md flex justify-center items-center cursor-pointer h-full size-20">
                                    <input type="file" accept="image/*" @change="onFileChange" multiple class="absolute top-0 left-0 h-full rounded-md placeholder:hidden text-transparent cursor-pointer" />
                                    <PlusCircle class="size-7 text-primary" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </VariantLayout>
    </AppLayout>
</template>