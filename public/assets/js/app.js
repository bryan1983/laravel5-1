
$(function(){

    var alert = new Alert('#notifications');

    function voteForm(form, button, buttonRevert)
    {
        var ticket = button.closest('.ticket');
        var id = ticket.data('id');
        var action = form.attr('action').replace(':id', id);
        var voteCount = ticket.find('.votes-count');

        buttonRevert = ticket.find(buttonRevert);
        button.addClass('hidden');

        this.getVotes = function(){
            return parseInt(voteCount.text().split(' ')[0]);
        };

        this.updateCount = function(votes){
            voteCount.text(votes == 1 ? "1 voto" : votes + ' votos');
        };

        this.submit = function(success){
            $.post(action,form.serialize(),
                function (response){
                    buttonRevert.removeClass('hidden');
                    success(response);
                }
            ).fail(function(){
                    button.removeClass('hidden');
                    alert.error('Ocurrió un error :(');
            });
        };
    }


    $('.btn-vote').bind('click', function(e){
        e.preventDefault();

        var VoteForm = new voteForm($('#form-vote'), $(this), '.btn-unvote');

        VoteForm.submit(function(response){
            if(response.success) {
                alert.success('¡Gracias por tu voto!');
                VoteForm.updateCount(VoteForm.getVotes() +1);
            }
        });
    });

    $('.btn-unvote').bind('click', function(e){
        e.preventDefault();

        var VoteForm = new voteForm($('#form-unvote'), $(this), '.btn-vote');

        VoteForm.submit(function(response){
            if(response.success) {
                alert.info('¡Voto eliminado!');
                VoteForm.updateCount(VoteForm.getVotes() -1);
            }
        });
    });
});
