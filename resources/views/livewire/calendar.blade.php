<div wire:ignore>
    <div class="pl-8">
        <h4 class="text-center">Instruções de Agendamento</h4>
        <h6>1- Selecione o dia em que deseja fazer a refeição.</h6>
        <h6>2- No box que aparecerá selecione as refeições desejadas, confirme o dia e aperte em 'Agendar'.</h6>
    </div>

    @include('admin.message')

    <div>
        @if (session()->has('message'))
        <div class="p-3 bg-green-300 text-green-700 rounded shadow-sm" id="alert">
            {{ session('message') }}
        </div>
        @endif
        <div>
            @error('refeicao')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="py-1 pl-8 pr-8" id="calendar"></div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLabel">Agendar refeição</h5>
                    @error('Reserva')<span class="text-red-500 text/xs">{{$message}} </span> @enderror

                    <form wire:submit.prevent='store' method="post" action="" id="cadRef">
                        <div class="form-group">
                            <label for="almoco" class="col-form-label">Almoço:</label>
                            <input type="checkbox" name='refeicao' wire:model="almoco" class="refeicao" value="almoco">
                        </div>
                        <div class="form-group">
                            <label for="janta" class="col-form-label">Janta:</label>
                            <input type="checkbox" name='refeicao' wire:model="janta" class="refeicao" value="janta">
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-form-label">Dia:</label>
                            <input type="date" name='start' wire:model.defer="start" class="refeicao" id="start">
                        </div>

                        <button type="submit" id="registerBtn" class="btn btn-primary">Agendar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cancelar </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div>
        @push('script')
        <script>
            $('#modalCreate').on('hiden.bs.modal', function() {
                @this.almoco = '';
                @this.janta = '';
                @this.start = '';
            })

            const calendarEl = document.getElementById('calendar');
            var events = @json($events);
            const calendar = new FullCalendar.Calendar(calendarEl, {
                events: events,
                weekends: false,
                initialView: 'dayGridMonth',
                locale: 'pt-BR',
                timeZone: 'America/Sao_Paulo',
                selectable: true,
                select: function({
                    startStr
                }) {
                    @this.start = startStr;
                    $('#modalCreate').modal('toggle');
                },
                eventClick: function(info) {
                    if (confirm('Deseja cancelar esta reserva?')) {
                        @this.destroy(info.event.id); // Chama a função destroy do Livewire
                    }
                }
            });
            calendar.render();
        </script>

        <script>
            setTimeout(function() {
                $("#alert").remove();
            }, 2000);
        </script>
        @endpush
    </div>
</div>