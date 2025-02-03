import { HTMLAttributes, useEffect } from 'react'
import { Link, useForm as useInertiaForm } from '@inertiajs/react'
import { cn } from '@/lib/utils'
import { Button } from '@/components/ui/button'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { PasswordInput } from '@/components/password-input'
import { Checkbox } from '@/components/ui/checkbox'
import { useForm } from 'react-hook-form'

type UserAuthFormProps = HTMLAttributes<HTMLDivElement> & {
  status?: string;
  canResetPassword?: boolean;
}

export function UserAuthForm({ className, status, canResetPassword = true, ...props }: UserAuthFormProps) {
  const { data, setData, post, processing, errors: inertiaErrors, reset } = useInertiaForm({
    email: 'shadcn@gmail.com',
    password: 'password',
    remember: false,
  });

  const form = useForm({
    defaultValues: {
      email: '',
      password: '',
      remember: false
    },
  })

  useEffect(() => {
    const subscription = form.watch((value) => {
      if (value.email !== undefined) setData('email', value.email);
      if (value.password !== undefined) setData('password', value.password);
      if (value.remember !== undefined) setData('remember', value.remember);
    });
    return () => subscription.unsubscribe();
  }, [form.watch, setData]);

  function onSubmit(formData: any) {
    post(route('login'), {
      onFinish: () => {
        reset('password');
        form.reset({
          ...form.getValues(),
          password: ''
        });
      },
      preserveScroll: true,
    });
  }

  return (
    <div className={cn('grid gap-6', className)} {...props}>
      {status && (
        <div className="text-sm font-medium text-green-600">
          {status}
        </div>
      )}

      <Form {...form}>
        <form onSubmit={form.handleSubmit(onSubmit)} noValidate>
          <div className='grid gap-2'>
            <FormField
              control={form.control}
              name='email'
              render={({ field }) => (
                <FormItem className='space-y-1'>
                  <FormLabel>Email</FormLabel>
                  <FormControl>
                    <Input
                      placeholder='name@example.com'
                      {...field}
                      autoComplete="username"
                      value={data.email}
                      onChange={(e) => {
                        field.onChange(e);
                        setData('email', e.target.value);
                      }}
                      aria-invalid={!!inertiaErrors.email}
                    />
                  </FormControl>
                  {inertiaErrors.email && (
                    <FormMessage>
                      {inertiaErrors.email}
                    </FormMessage>
                  )}
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name='password'
              render={({ field }) => (
                <FormItem className='space-y-1'>
                  <div className='flex items-center justify-between'>
                    <FormLabel>Password</FormLabel>
                    {canResetPassword && (
                      <Link
                        href={route('password.request')}
                        className='text-sm font-medium text-muted-foreground hover:opacity-75'
                        tabIndex={1}
                      >
                        Forgot password?
                      </Link>
                    )}
                  </div>
                  <FormControl>
                    <PasswordInput
                      placeholder='********'
                      {...field}
                      autoComplete="current-password"
                      value={data.password}
                      onChange={(e) => {
                        field.onChange(e);
                        setData('password', e.target.value);
                      }}
                      aria-invalid={!!inertiaErrors.password}
                    />
                  </FormControl>
                  {inertiaErrors.password && (
                    <FormMessage>
                      {inertiaErrors.password}
                    </FormMessage>
                  )}
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="remember"
              render={({ field }) => (
                <FormItem className="flex flex-row items-center space-x-2 space-y-0 mt-2">
                  <FormControl>
                    <Checkbox
                      checked={data.remember}
                      onCheckedChange={(checked) => {
                        field.onChange(checked);
                        setData('remember', checked as boolean);
                      }}
                    />
                  </FormControl>
                  <FormLabel className="text-sm font-normal text-muted-foreground">
                    Remember me
                  </FormLabel>
                </FormItem>
              )}
            />

            <Button className='mt-4' disabled={processing}>
              {processing ? 'Logging in...' : 'Login'}
            </Button>
          </div>
        </form>
      </Form>
    </div>
  )
}
