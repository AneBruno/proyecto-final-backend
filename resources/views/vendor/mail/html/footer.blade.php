<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell" align="center">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                    @if ($unsuscribeRoute)
                        Para desuscribirse, haga click <a href={{$unsuscribeRoute}}>aquí</a>
                    @endif

                </td>
            </tr>
        </table>
    </td>
</tr>

