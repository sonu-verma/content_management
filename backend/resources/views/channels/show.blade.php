<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $channel->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="channel_container_edit">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form class="space-y-6" id="channel_update_form" method="POST" action="{{ route('channels.update', $channel->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group flex justify-center">
                            <div class="channel-avatar" onclick="document.getElementById('channel_image_upload').click()"> 
                                @if($channel->editable())
                                <div class="channel-avatar-overlay">
                                    <svg fill="#000000" height="64px" width="64px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 501.333 501.333" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M250.667,182.4c-61.867,0-112,50.133-112,112s50.133,112,112,112c61.867,0,112-50.133,112-112 C362.667,232.533,312.534,182.4,250.667,182.4z M250.667,364.8c-38.4,0-70.4-32-70.4-70.4s32-70.4,70.4-70.4 c38.4,0,70.4,32,70.4,70.4S289.067,364.8,250.667,364.8z"></path> </g> </g> <g> <g> <path d="M425.6,101.333h-48l-1.067-10.667C371.2,53.333,336,24.533,294.4,24.533h-73.6c-41.6,0-76.8,28.8-82.133,66.133 l-1.067,10.667h-35.2V90.667c0-11.733-9.6-21.333-21.333-21.333s-21.333,9.6-21.333,21.333V102.4C25.6,108.8,0,136.534,0,170.667 v236.8c0,38.4,34.133,69.333,75.733,69.333H425.6c41.6,0,75.733-30.933,75.733-69.333v-236.8 C501.334,132.267,467.2,101.333,425.6,101.333z M425.6,435.2H75.734c-19.2,0-34.133-12.8-34.133-27.733v-236.8 c0-16,14.933-27.733,34.133-27.733h80c9.6,0,19.2-7.467,20.267-18.133l4.267-28.8c2.133-17.067,19.2-29.867,40.533-29.867h73.6 c20.267,0,38.4,12.8,40.533,29.867l4.267,28.8c1.067,10.667,9.6,18.133,20.267,18.133H425.6c19.2,0,34.133,12.8,34.133,27.733 v236.8h0C459.734,423.467,444.8,435.2,425.6,435.2z"></path> </g> </g> <g> <g> <path d="M404.267,170.667h-9.6c-11.733,0-21.333,9.6-21.333,21.333s9.6,21.333,21.333,21.333h9.6 c11.733,0,21.333-9.6,21.333-21.333S416,170.667,404.267,170.667z"></path> </g> </g> </g></svg>
                                </div>
                                @endif
                                <img src="{{ $channel->image() }}" alt="Channel Image" />
                            </div>
                            @if($channel->editable())
                            <input 
                                onchange="document.getElementById('channel_update_form').submit()" 
                                type="file" 
                                id="channel_image_upload" 
                                name="channel_image" 
                                style="display: none;" 
                            />
                            @endif
                        </div>
                        @error('channel_image')
                            <p class="text-sm text-center flex justify-center text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                        <div class="form-container">
                        @if($channel->editable())
                            <div class="form-group">
                                <label for="title" class="block font-medium text-sm text-gray-700">
                                    {{ __('Title') }}
                                </label>
                                <input id="title"
                                    type="text"
                                    name="title"
                                    value="{{ $channel->title }}"
                                    autofocus
                                    autocomplete="title"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                @error('title')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="block font-medium text-sm text-gray-700">
                                    {{ __('Description') }}
                                </label>
                                <textarea id="title"
                                    type="text"
                                    name="description"
                                    autofocus
                                    autocomplete="description"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{!! trim($channel->description) !!}</textarea>
                                @error('description')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input
                                    type="submit" 
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-1 rounded-md font-semibold text-xs uppercase tracking-widest hover:border-red-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" value="Update Channel"
                                />
                            </div>
                        @endif
                        
                        </div>
                    </form>
                    
                    @if(!$channel->editable())
                            <div class="channel-info center align-middle p-10">
                                <div class="form-group ">
                                    <label for="title" class="text-center font-medium text-lg text-gray-700">
                                        {{ $channel->user->name }}
                                    </label>
                                </div>
                                 <div class="form-group ">
                                    <label for="title" class="text-center font-medium text-lg text-gray-700">
                                        {{ $channel->title }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="font-medium text-sm text-gray-700">
                                        {{ $channel->description }}
                                    </label>
                                </div>
                                
                            </div>
                    @endif

                    {!!  $subscriptionButton !!}
                </div>
            </div>
        </div>
    </div>

    @section('css')
        <style>
            .channel_container_edit{
                max-width: 500px;
                margin: auto;
            }

            .channel-avatar {
                width: 100px; 
                height: 100px; 
                border: 1px solid black;
                cursor: pointer; 
                .channel-avatar-overlay{ 
                    display:none; 
                }
                position: relative;
                &:hover{
                    .channel-avatar-overlay{ 
                        background: #efebeb; 
                        width: 100%;
                        height: 100%;
                        display:flex; 
                        position: absolute;
                        justify-content: center; 
                        align-items: center;
                    
                    }
                }
            }

            .channel-info{
                text-align: center !important;
            }
            
        </style>
    @endsection

    @section('scripts')
        <script>

            let loginUrl = "{{  route('login') }}"
            $(document).on('click', '#checkSubscriptionAction', function () {
                $.ajax({
                    method: $(this).data('type') == 'Subscribed' ? "POST" : "DELETE",
                    url: $(this).data('url'),
                    success: function (response){
                        console.log(response.statusCode)
                        if(response.statusCode === 200){
                            Swal.fire({
                                icon: "success",
                                text: response.message,
                                showCloseButton: true,
                                showCancelButton: false,
                                showConfirmButton: false,
                                focusConfirm: false,
                            });
                        }else{
                            Swal.fire({
                                icon: "error",
                                text: response.message,
                                showCloseButton: true,
                                showCancelButton: false,
                                showConfirmButton: false,
                                focusConfirm: false,
                                footer: '<a href="'+loginUrl+'">Login</a>'
                            });
                        }

                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                        
                    },
                    error: function(error){
                        console.log("Errro:", error)
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
