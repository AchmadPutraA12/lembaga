<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <p class="mb-1">Kami dengan ini mengonfirmasi bahwa pengguna</p>
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <th>Nip</th>
                        <td>:</td>
                        <td>{{  Auth::user()->nip }}</td>
                    </tr>
                </table>
                <p class="mt-1">yang tercantum telah setuju untuk bertindak sebagai penanggung jawab atas data yang dibuat.</p>
                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                <label class="checkbox checkbox-primary">
                    <input type="checkbox" name="agreement" required /><span>Checklist Untuk Menyetujui</span><span style="color: red">*</span><span class="checkmark"></span>
                </label>
            </div>
        </div>
    </div>
</div>
