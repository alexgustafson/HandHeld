//
//  AppDelegate.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "StartViewController.h"


@interface AppDelegate : UIResponder <UIApplicationDelegate>
{
    BOOL debug_mode_enabled;


}

@property (strong, nonatomic) UIWindow *window;
@property (nonatomic, assign) BOOL debug_mode_enabled;

- (void)hhAction:(NSNotification *)notification;

@end
