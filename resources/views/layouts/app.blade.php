<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Orders')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        body {
            background: #0f172a;
            color: #e5e7eb;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        a { color: inherit; text-decoration: none; }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #020617;
            border-bottom: 1px solid #1f2937;
        }
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .navbar-logo {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
        }
        .navbar-title {
            font-weight: 600;
            font-size: 18px;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 14px;
        }
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .avatar {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            background: #1f2937;
        }

        .layout {
            display: flex;
            flex: 1;
            min-height: 0;
        }
        .sidebar {
            width: 220px;
            background: #020617;
            border-right: 1px solid #1f2937;
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            font-size: 14px;
        }
        .sidebar-section-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            color: #9ca3af;
            cursor: pointer;
            transition: all 0.2s;
        }
        .sidebar-link.active {
            background: #111827;
            color: #e5e7eb;
            border-left: 3px solid #4f46e5;
        }
        .sidebar-link:hover {
            background: #111827;
        }
        .sidebar-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #6b7280;
        }
        .sidebar-link.active .sidebar-dot {
            background: #4f46e5;
        }

        .content-wrapper {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
        }
        .content-title {
            font-size: 24px;
            font-weight: 600;
        }
        .content-subtitle {
            font-size: 14px;
            color: #9ca3af;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            border: none;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 14px;
            cursor: pointer;
            color: #f9fafb;
        }
        .btn-primary:hover { opacity: 0.95; }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .card {
            background: #020617;
            border-radius: 16px;
            padding: 16px;
            border: 1px solid #1f2937;
        }
        .card-label {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 4px;
        }
        .card-value {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .card-trend {
            font-size: 12px;
            color: #22c55e;
        }

        .panel {
            background: #020617;
            border-radius: 16px;
            border: 1px solid #1f2937;
            padding: 16px;
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .panel-title {
            font-size: 16px;
            font-weight: 500;
        }
        .chip {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 16px;
            background: #111827;
            color: #9ca3af;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        thead {
            color: #6b7280;
            text-align: left;
        }
        th, td {
            padding: 10px 8px;
            border-bottom: 1px solid #111827;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            display: inline-block;
        }
        .status-paid {
            background: rgba(34, 197, 94, 0.1);
            color: #2d4435;
        }
        .status-pending {
            background: rgba(234, 179, 8, 0.1);
            color: #eab308;
        }
        .status-cancelled {
            background: rgba(248, 113, 113, 0.1);
            color: #3b1397;
        }

        @media (max-width: 1024px) {
            .layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
            }
            .cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 640px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }
            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <div class="navbar-logo"></div>
            <div class="navbar-title">Mama Orders</div>
        </div>
        <div class="navbar-right">
            <span>Dashboard</span>
            <div class="navbar-user">
                <div class="avatar"></div>
                <span>Admin</span>
            </div>
        </div>
    </div>

    <div class="layout">
        <aside class="sidebar">
            <div>
                <div class="sidebar-section-title">Main</div>
                
                <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                    <span class="sidebar-dot"></span>
                    <span>Overview</span>
                </a>
                
                <a href="{{ route('people.index') }}" class="sidebar-link {{ request()->routeIs('people.*') ? 'active' : '' }}">
                    <span class="sidebar-dot"></span>
                    <span>Orders</span>
                </a>
                
                <a href="#" class="sidebar-link">
                    <span class="sidebar-dot"></span>
                    <span>Customers</span>
                </a>
            </div>
        </aside>

        <main class="content-wrapper">
            @yield('content')
        </main>
    </div>
</body>
</html>
