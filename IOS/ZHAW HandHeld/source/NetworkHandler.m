//
//  NetworkHandler.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "NetworkHandler.h"

@implementation NetworkHandler
@synthesize wifiActive, hostActive, delegate;

- (id)initwithDelegate:(id)delegate
{
    self = [super init];
    if (self) {
        
        [self setDelegate:delegate];
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(checkNetworkStatus:) name:kReachabilityChangedNotification object:nil];
        
        wifiReachable = [[Reachability reachabilityForLocalWiFi] retain];
        [wifiReachable startNotifier];
        
        // check if a pathway to a random host exists
        hostReachable = [[Reachability reachabilityWithHostName: @"www.againstyou.net"] retain];
        [hostReachable startNotifier];
        
    }
    return self;
}

-(void) checkNetworkStatus:(NSNotification *)notice
{
    // called after network status changes
    NetworkStatus internetStatus = [wifiReachable currentReachabilityStatus];
    switch (internetStatus)
    {
        case NotReachable:
        {
            NSLog(@"The internet is down.");
            wifiActive = NO;
            
            break;
        }
        case ReachableViaWiFi:
        {
            NSLog(@"The internet is working via WIFI.");
            wifiActive = YES;
            
            break;
        }
        case ReachableViaWWAN:
        {
            NSLog(@"The internet is working via WWAN.");
            wifiActive = YES;
            
            break;
        }
    }
    
    NetworkStatus hostStatus = [hostReachable currentReachabilityStatus];
    switch (hostStatus)
    {
        case NotReachable:
        {
            NSLog(@"A gateway to the host server is down.");
            hostActive = NO;
            
            break;
        }
        case ReachableViaWiFi:
        {
            NSLog(@"A gateway to the host server is working via WIFI.");
            hostActive = YES;
            
            break;
        }
        case ReachableViaWWAN:
        {
            NSLog(@"A gateway to the host server is working via WWAN.");
            hostActive = YES;
            
            break;
        }
    }
    [delegate startApp];
}




@end
