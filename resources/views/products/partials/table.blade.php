@forelse($products as $product)
    <tr class="hover:bg-slate-50 transition-colors">
        <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-500">{{ $product->sku ?? 'N/A' }}</td>
        <td class="whitespace-nowrap px-6 py-4">
            @if($product->image)
                <img src="{{ asset('images/products/' . $product->image) }}" alt="Imagen de {{ $product->name }}" class="h-10 w-10 rounded-md object-cover border border-slate-200">
            @else
                <div class="h-10 w-10 rounded-md bg-slate-100 flex items-center justify-center border border-slate-200" title="Sin imagen">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
            @endif
        </td>
        <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">{{ $product->name }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-slate-500">
            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-800">
                {{ $product->category->name ?? 'Sin categoría' }}
            </span>
        </td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-slate-900 font-medium">${{ number_format($product->price, 2) }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-right text-slate-500">{{ $product->stock }}</td>
        <td class="whitespace-nowrap px-6 py-4 text-center">
            <button class="text-slate-500 hover:text-slate-900 px-2 transition-colors" title="Editar">
                <svg class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-6 py-8 text-center text-slate-500">No hay productos disponibles.</td>
    </tr>
@endforelse
