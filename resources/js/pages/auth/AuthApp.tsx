import React, { useMemo, useState } from 'react';
import { Button, Checkbox, Label, TextInput, Alert } from 'flowbite-react';

function useCsrfToken() {
  return useMemo(() => {
    const fromWindow = (window as any).__CSRF;
    if (typeof fromWindow === 'string' && fromWindow.length > 0) {
      return fromWindow;
    }

    const meta = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null;
    return meta?.getAttribute('content') ?? '';
  }, []);
}

export default function AuthApp() {
  const csrf = useCsrfToken();
  const [reg, setReg] = useState({ name: '', email: '', password: '', password_confirmation: '' });
  const [login, setLogin] = useState({ email: '', password: '', remember: false });
  const flash = (window as any).__FLASH || {};

  return (
    <div className="min-h-screen flex items-center justify-center bg-background py-12 px-4">
      <div className="w-full max-w-4xl">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div className="rounded-lg shadow-lg overflow-hidden bg-card">
            <div className="p-8">
              <h2 className="text-2xl font-semibold text-card-foreground mb-6">Create an account</h2>

              {flash.success && <div className="mb-4"><Alert color="success">{flash.success}</Alert></div>}

              <form action="/register" method="POST" className="space-y-5">
                <input type="hidden" name="_token" value={csrf} />

                <div>
                  <Label htmlFor="reg-name" className="text-card-foreground/80 mb-1">Name</Label>
                  <TextInput
                    id="reg-name"
                    name="name"
                    value={reg.name}
                    onChange={(e) => setReg({ ...reg, name: e.target.value })}
                    required
                    placeholder="Your full name"
                    className="input input-bordered w-full bg-background text-card-foreground"
                  />
                </div>

                <div>
                  <Label htmlFor="reg-email" className="text-card-foreground/80 mb-1">Email</Label>
                  <TextInput
                    id="reg-email"
                    name="email"
                    type="email"
                    value={reg.email}
                    onChange={(e) => setReg({ ...reg, email: e.target.value })}
                    required
                    placeholder="name@example.com"
                    className="input input-bordered w-full bg-background text-card-foreground"
                  />
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <Label htmlFor="reg-password" className="text-card-foreground/80 mb-1">Password</Label>
                    <TextInput
                      id="reg-password"
                      name="password"
                      type="password"
                      value={reg.password}
                      onChange={(e) => setReg({ ...reg, password: e.target.value })}
                      required
                      placeholder="••••••••"
                      className="input input-bordered w-full bg-background text-card-foreground"
                    />
                  </div>

                  <div>
                    <Label htmlFor="reg-password-confirm" className="text-card-foreground/80 mb-1">Confirm</Label>
                    <TextInput
                      id="reg-password-confirm"
                      name="password_confirmation"
                      type="password"
                      value={reg.password_confirmation}
                      onChange={(e) => setReg({ ...reg, password_confirmation: e.target.value })}
                      required
                      placeholder="••••••••"
                      className="input input-bordered w-full bg-background text-card-foreground"
                    />
                  </div>
                </div>

                <div className="pt-2">
                  <Button color="primary" type="submit" className="w-full btn-primary">
                    Create account
                  </Button>
                </div>
              </form>
            </div>
          </div>

          <div className="rounded-lg shadow-lg overflow-hidden bg-card">
            <div className="p-8">
              <h2 className="text-2xl font-semibold text-card-foreground mb-6">Sign in</h2>

              <form action="/login" method="POST" className="space-y-5">
                <input type="hidden" name="_token" value={csrf} />

                <div>
                  <Label htmlFor="login-email" className="text-card-foreground/80 mb-1">Email</Label>
                  <TextInput id="login-email" name="email" type="email" value={login.email} onChange={(e) => setLogin({ ...login, email: e.target.value })} required placeholder="name@example.com" className="input input-bordered w-full bg-background text-card-foreground" />
                </div>

                <div>
                  <Label htmlFor="login-password" className="text-card-foreground/80 mb-1">Password</Label>
                  <TextInput id="login-password" name="password" type="password" value={login.password} onChange={(e) => setLogin({ ...login, password: e.target.value })} required placeholder="••••••••" className="input input-bordered w-full bg-background text-card-foreground" />
                </div>

                <div className="flex items-center justify-between">
                  <label className="flex items-center gap-2">
                    <Checkbox name="remember" checked={login.remember} onChange={(e) => setLogin({ ...login, remember: (e.target as HTMLInputElement).checked })} />
                    <span className="text-card-foreground/80 ml-2">Remember me</span>
                  </label>
                  <a href="#" className="text-primary-foreground">Forgot?</a>
                </div>

                <div className="pt-2">
                  <Button color="primary" type="submit" className="w-full btn-primary">Sign in</Button>
                </div>
              </form>

              {Array.isArray(flash.errors) && flash.errors.length > 0 && (
                <div className="mt-4 text-red-400 text-sm">
                  {flash.errors.map((err: string, idx: number) => <div key={idx}>{err}</div>)}
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}