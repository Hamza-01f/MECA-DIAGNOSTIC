<!DOCTYPE html>
<html>
<head>
    <title>Facture de Diagnostic - Meca Diagnostic</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #e1e1e1;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 20px;
        }
        .company-info {
            text-align: left;
        }
        .invoice-info {
            text-align: right;
        }
        .logo {
            max-width: 180px;
            margin-bottom: 10px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .invoice-number {
            font-size: 16px;
            color: #666;
        }
        .date {
            font-size: 14px;
            margin-top: 5px;
        }
        .client-info {
            margin-bottom: 30px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-table th {
            background-color: #2c3e50;
            color: white;
            text-align: left;
            padding: 10px;
        }
        .info-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .info-table .label {
            font-weight: bold;
            width: 30%;
            background-color: #f5f5f5;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #2c3e50;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .stamp {
            float: right;
            opacity: 0.7;
            max-width: 120px;
            margin-top: -30px;
        }
        .terms {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
        .na { 
            color: #999; 
            font-style: italic; 
        }
    </style>
</head>
<body>
    <div class="invoice-container">
       
        <div class="header">
            <div class="company-info">
                <div class="company-name">MECA DIAGNOSTIC</div>
            </div>
            <div class="invoice-info">
                <div class="invoice-title">FACTURE</div>
                <div class="invoice-number">N° DIAG-{{ str_pad($diagnostic->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="date">Date: {{ now()->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Client information -->
        <div class="client-info">
            <strong>CLIENT:</strong><br>
            <p>Nom : {{ $diagnostic->client->name ?? '<span class="na">N/A</span>' }}</p>
            <p>Tele : {{ $diagnostic->client->phone ?? '<span class="na">N/A</span>' }}</p>
            @if($diagnostic->client && $diagnostic->client->address)
            <p>Address : {{ $diagnostic->client->address }}</p> 
            <p>City : {{ $diagnostic->client->city }}</p>
            @endif
        </div>

        <!-- Vehicle information -->
        <div style="margin-bottom: 20px;">
            <strong>VÉHICULE:</strong><br>
            @if($diagnostic->vehicule)
                {{ $diagnostic->vehicule->marque }} {{ $diagnostic->vehicule->model }}<br>
                Immatriculation: {{ $diagnostic->vehicule->matricule }}
            @else
                <span class="na">Information véhicule non disponible</span>
            @endif
        </div>

        <table class="info-table">
            <thead>
                <tr>
                    <th>Nome du service</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Diagnostic {{ $diagnostic->service->name ?? 'Service' }}</strong><br>
                        @if($diagnostic->findings)
                            <small>Découvertes: {{ $diagnostic->findings }}</small>
                        @endif
                    </td>
                    <td>{{ $diagnostic->date ? $diagnostic->date->format('d/m/Y') : 'N/A' }}</td>
                    <!-- first letter will be capital -->
                    <td>{{ ucfirst($diagnostic->status) }}</td>
                    <td>
                        @if($diagnostic->service)
                            {{ number_format($diagnostic->service->price, 2) }} DH
                        @else
                            <span class="na">N/A</span>
                        @endif
                    </td>
                </tr>
               
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Sous-total:</strong></td>
                    <td>
                        @if($diagnostic->service)
                           <!-- format the price to be like 99.00-->
                            {{ number_format($diagnostic->service->price, 2) }} DH
                        @else
                            <span class="na">N/A</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>TVA (20%):</strong></td>
                    <td>
                        @if($diagnostic->service)
                            {{ number_format($diagnostic->service->price * 0.2, 2) }} DH
                        @else
                            <span class="na">N/A</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total TTC:</strong></td>
                    <td class="total-amount">
                        @if($diagnostic->service)
                            {{ number_format($diagnostic->service->price * 1.2, 2) }} DH
                        @else
                            <span class="na">N/A</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>


        <div class="footer">
            <p>Merci Pour Votre Confiance</p>
            <p>© {{ date('Y') }} MECA DIAGNOSTIC  , Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>