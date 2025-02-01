import { HTMLAttributes } from 'react'
import { z } from 'zod'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
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

type UserAuthFormProps = HTMLAttributes<HTMLDivElement> & {
  status?: string;
  canResetPassword?: boolean;
}

const formSchema = z.object({
  email: z
    .string()
    .min(1, { message: 'Please enter your email' })
    .email({ message: 'Invalid email address' }),
  password: z
    .string()
    .min(1, {
      message: 'Please enter your password',
    })
    .min(7, {
      message: 'Password must be at least 7 characters long',
    }),
})

export function UserAuthForm({ className, status, canResetPassword = true, ...props }: UserAuthFormProps) {
  const { post, processing, errors: inertiaErrors, reset } = useInertiaForm({
    email: '',
    password: '',
    remember: false,
  });

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      email: '',
      password: '',
      remember: false
    },
  })

  function onSubmit(data: z.infer<typeof formSchema>) {
    post(route('login'), {
      onFinish: () => {
        reset('password');
        form.reset();
      },
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
        <form onSubmit={form.handleSubmit(onSubmit)}>
          <div className='grid gap-2'>
            <FormField
              control={form.control}
              name='email'
              render={({field}) => (
                <FormItem className='space-y-1'>
                  <FormLabel>Email</FormLabel>
                  <FormControl>
                    <Input
                      placeholder='name@example.com'
                      {...field}
                      autoComplete="username"
                    />
                  </FormControl>
                  <FormMessage>
                    {inertiaErrors.email}
                  </FormMessage>
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name='password'
              render={({field}) => (
                <FormItem className='space-y-1'>
                  <div className='flex items-center justify-between'>
                    <FormLabel>Password</FormLabel>
                    {canResetPassword && (
                      <Link
                        href={route('password.request')}
                        className='text-sm font-medium text-muted-foreground hover:opacity-75'
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
                    />
                  </FormControl>
                  <FormMessage>
                    {inertiaErrors.password}
                  </FormMessage>
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="remember"
              render={({field}) => (
                <FormItem className="flex flex-row items-center space-x-2 space-y-0 mt-2">
                  <FormControl>
                    <Checkbox
                      checked={field?.value}
                      onCheckedChange={field.onChange}
                    />
                  </FormControl>
                  <FormLabel className="text-sm font-normal text-muted-foreground">
                    Remember me
                  </FormLabel>
                </FormItem>
              )}
            />

            <Button className='mt-4' disabled={processing}>
              Login
            </Button>
          </div>
        </form>
      </Form>
    </div>
  )
}
