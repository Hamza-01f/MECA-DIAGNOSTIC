<!DOCTYPE html>
<html>
<head>
    <title>Diagnostic Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { width: 150px; }
        .title { font-size: 24px; font-weight: bold; }
        .subtitle { font-size: 16px; color: #666; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #ddd; margin-bottom: 5px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 5px; border: 1px solid #ddd; }
        .info-table .label { font-weight: bold; width: 30%; }
        .findings { margin-top: 20px; }
        .signature { margin-top: 50px; }
        .footer { margin-top: 50px; font-size: 12px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Rapport de Diagnostic</div>
        <div class="subtitle">N° {{ $diagnostic->id }}</div>
    </div>
    
    <table class="info-table">
        <tr>
            <td class="label">Client:</td>
            <td>{{ $diagnostic->client->name }}</td>
            <td class="label">Téléphone:</td>
            <td>{{ $diagnostic->client->phone }}</td>
        </tr>
        <tr>
            <td class="label">Véhicule:</td>
            <td>{{ $diagnostic->vehicule->marque }} {{ $diagnostic->vehicule->model }}</td>
            <td class="label">Matricule:</td>
            <td>{{ $diagnostic->vehicule->matricule }}</td>
        </tr>
        <tr>
            <td class="label">Date:</td>
            <td>{{ $diagnostic->date->format('d/m/Y') }}</td>
            <td class="label">Statut:</td>
            <td>{{ ucfirst($diagnostic->status) }}</td>
        </tr>
        <tr>
            <td class="label">Service:</td>
            <td>{{ $diagnostic->service->name }}</td>
            <td class="label">Coût:</td>
            <td>{{ number_format($diagnostic->service->price, 2) }} DH</td>
        </tr>
    </table>
    
    <div class="footer">
        <p>Merci pour votre confiance</p>
        <p>© {{ date('Y') }} Votre Garage. Tous droits réservés.</p>
    </div>
</body>
</html>