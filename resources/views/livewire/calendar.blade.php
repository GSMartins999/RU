<div wire:ignore>
    <div class="pl-8">
        <h4 class="text-center">Instruções de Agendamento</h4>
        <h6>1- Selecione o dia em que deseja fazer a refeição.</h6>
        <h6>2- No box que aparecerá selecione as refeições desejadas, confirme o dia e aperte em 'Agendar'.</h6>
    </div>

    <div class="py-1 pl-8 pr-8" id="calendar"></div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Agendar refeição</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="message-container">
                        @if (session()->has('message'))
                        <div class="text-center mb-4">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                        @endif

                        @error('start')
                        <div class="text-center mb-4">
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror

                        @error('refeicao')
                        <div class="text-center mb-4">
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                    </div>

                    <form wire:submit.prevent='store' id="cadRef">
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
                            <input type="date" name='start' wire:model.defer="start" class="form-control" id="start" required>
                        </div>

                        <button type="submit" id="registerBtn" class="btn btn-primary">Agendar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        $('#modalCreate').on('hidden.bs.modal', function() {
            $('#message-container').html(''); 
        });

        const calendarEl = document.getElementById('calendar');
        var events = @json($events);
        const calendar = new FullCalendar.Calendar(calendarEl, {
            events: events,
            weekends: false, 
            initialView: 'dayGridMonth',
            locale: 'pt-BR',
            timeZone: 'America/Sao_Paulo',
            selectable: true,
            select: function({ startStr }) {
                @this.start = startStr;
                $('#modalCreate').modal('toggle');
            },
            eventClick: function(info) {
                if (confirm('Deseja cancelar esta reserva?')) {
                    @this.destroy(info.event.id);
                }
            }
        });
        calendar.render();

        window.addEventListener('recarregar-pagina', function(event) {
            console.log("Evento 'recarregar-pagina' recebido!");
            location.reload(); 
        });

        Livewire.on('mensagem', (message, type) => {
            let messageContainer = $('#message-container');
            messageContainer.html(''); 
            let alertClass = type === 'sucesso' ? 'alert-success' : 'alert-danger'; 
            messageContainer.append(`
                <div class="text-center mb-4">
                    <div class="alert ${alertClass}">
                        ${message}
                    </div>
                </div>
            `);
        });

        function showError(message) {
            let messageContainer = $('#message-container');
            messageContainer.html(`
                <div class="text-center mb-4">
                    <div class="alert alert-danger">
                        ${message}
                    </div>
                </div>
            `);
        }
    </script>
    @endpush
</div>
